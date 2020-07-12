<?php 

class Service extends CI_Controller {

	public function __construct() {

		parent::__construct();

	}

	public function get_kajian() {

		$this->load->model( 'jadwal_model', 'jadwal_m' );
		$jadwal = $this->jadwal_m->get_jadwal();
// 		echo '<pre>';
// 		var_dump($jadwal);
//         echo '</pre>';
        echo json_encode( $jadwal );
        
	}
	
	public function get_slider() {

		$this->load->model( 'slider_model', 'slider_m' );
		$slider = $this->slider_m->get_slider_awal();
// 		echo '<pre>';
// 		var_dump($jadwal);
//         echo '</pre>';
        echo json_encode( $slider );
	}
	
	public function register() {
	    
	    $this->load->model( 'user_model', 'user_m' );
	    $jenis_kelamin = $this->input->post( 'jenis_kelamin' );
	    $user = [
	        'id_user'   => $this->user_m->getkode(),
	        'nama'      => $this->input->post( 'nama' ),
	        'alamat'    => $this->input->post( 'alamat' ),
	        'email'     => $this->input->post( 'email' ),
	        'password'  => md5( $this->input->post( 'password' ) ),
	        'jk'        => $jenis_kelamin ? 'L' : 'P',
	        'no_hp'     => $this->input->post( 'nomor_hp' ),
	        'status'    => 'Y'
	    ];
	    
	    $response['success'] = false;
	    $user_id = $this->user_m->save( $user );
	    if ( $this->db->affected_rows() > 0 ) {
	        $response['success'] = true;
	        $response['user_id'] = $user_id;
	    }
	    
	    echo json_encode( $response );
	    
	}
	
	public function login() {
	    
	    $this->load->model( 'user_model', 'user_m' );
	    $user = $this->user_m->sign_in( $this->input->post( 'email' ), $this->input->post( 'password' ) );
	    $response['loggedIn'] = false;
	    if ( $user ) {
	        $response['loggedIn']       = true;
	        $response['accessToken']    = base64_encode( $user->id_user ) . '.' . base64_encode( date( 'YmdHis' ) );
	        $this->user_m->edit($user->id_user, [ 'id_token' => $response['accessToken'] ]);
	        $response['user'] = $user;
	    }
	    echo json_encode( $response );
	    
	}
	
	public function check_access_token() {
	    
	    $this->load->model( 'user_model', 'user_m' );
	    $token = $this->input->post( 'token' );
	    $parsedTokens = explode( '.', $token );
	    $user_id = base64_decode( $parsedTokens[0] );
	    $user = $this->user_m->get($user_id);
	    
	    $response['loggedIn'] = false;
	    if ( $user ) {
	        $response['loggedIn'] = true;
	        $response['accessToken']    = base64_encode( $user->id_user ) . '.' . base64_encode( date( 'YmdHis' ) );
	        $this->user_m->edit($user->id_user, [ 'id_token' => $response['accessToken'] ]);
	        $response['user'] = $user;
	    }
	    
	    echo json_encode( $response );
	}
	
	public function check_attendance() {
	    
	    $this->load->model( 'kehadiran_model', 'kehadiran_m' );
	    $kehadiran = $this->kehadiran_m->get_kehadiran([
            'id_user'   => $this->input->post( 'id_user' ),
            'id_jadwal' => $this->input->post( 'id_jadwal' )
        ]);
        
        $response['attendance'] = 2;
        if ( $kehadiran ) {
            $response['attendance'] = $kehadiran->konfirmasi == 'Insya Allah' ? 1 : 0;
        }
        
        echo json_encode( $response );
	    
	}

	public function set_kehadiran() {

        $this->load->model( 'kehadiran_model', 'kehadiran_m' );
		$kehadiran = $this->input->post( 'attendance' );
		switch ( $kehadiran ) {

			case 0:
                $kehadiran_user = $this->kehadiran_m->get_kehadiran([
                    'id_user'   => $this->input->post( 'id_user' ),
                    'id_jadwal' => $this->input->post( 'id_jadwal' )
                ]);
                
                if ( $kehadiran_user ) {
                    $this->kehadiran_m->edit([ 'id_konfir' => $kehadiran_user->id_konfir ], [
                            'konfirmasi'    => 'Tidak'
                        ]);
                } else {
                    $this->kehadiran_m->save([
                        'id_konfir' => $this->kehadiran_m->getkode(),
                        'id_user'   => $this->input->post( 'id_user' ),
                        'id_jadwal' => $this->input->post( 'id_jadwal' ),
                        'konfirmasi'=> 'Tidak'
                    ]);
                }
				break;

			case 1:
			    $kehadiran_user = $this->kehadiran_m->get_kehadiran([
                    'id_user'   => $this->input->post( 'id_user' ),
                    'id_jadwal' => $this->input->post( 'id_jadwal' )
                ]);
                
                if ( $kehadiran_user ) {
                    $this->kehadiran_m->edit([ 'id_konfir' => $kehadiran_user->id_konfir ], [
                            'konfirmasi'    => 'Insya Allah'
                        ]);
                } else {
                    $this->kehadiran_m->save([
                        'id_konfir' => $this->kehadiran_m->getkode(),
                        'id_user'   => $this->input->post( 'id_user' ),
                        'id_jadwal' => $this->input->post( 'id_jadwal' ),
                        'konfirmasi'=> 'Insya Allah'
                    ]);
                }
				break;

			case 2: // check attendance
				$kehadiran_user = $this->kehadiran_m->get_kehadiran([
                    'id_user'   => $this->input->post( 'id_user' ),
                    'id_jadwal' => $this->input->post( 'id_jadwal' )
                ]);
                
                if ( $kehadiran_user ) {
                    $this->kehadiran_m->delete( $kehadiran_user->id_konfir );
                } 
				break;
		}
		
		echo json_encode([]);

	}

	public function index() {

		$data = [
			[
				'title'		=> 'Sholat Sunnah yang Menyamai Pahala Sholat Wajib1',
				'lecturer'	=> 'Ustadz Mizan Qudsiyah, Lc',
				'imgSrc' 	=> 'http://placehold.it/350x200',
				'location'	=> 'Masjid Agung Palembang',
				'date'		=> '06 Maret 2018',
				'time'		=> '19.00 am',
				'details'	=> [
					'description'	=> 'Akan dilaksanakan kajian bertema Sholat Sunnah yang Menyamai Pahala Sholat Wajib. Insya Allah akan dilaksanakan di Masjid Bakti. Jln. Subakti Palembang pada hari Rabu waktu setelah Ba\'da Maghrib',
					'coordinate'	=> [
						'lat'	=> 37.78825,
						'lng'	=> -122.4324
					]
				]
			],
			[
				'title'		=> 'Sholat Sunnah yang Menyamai Pahala Sholat Wajib2',
				'lecturer'	=> 'Ustadz Mizan Qudsiyah, Lc',
				'imgSrc' 	=> 'http://placehold.it/350x200',
				'location'	=> 'Masjid Agung Palembang',
				'date'		=> '06 Maret 2018',
				'time'		=> '19.00 am',
				'details'	=> [
					'description'	=> 'Akan dilaksanakan kajian bertema Sholat Sunnah yang Menyamai Pahala Sholat Wajib. Insya Allah akan dilaksanakan di Masjid Bakti. Jln. Subakti Palembang pada hari Rabu waktu setelah Ba\'da Maghrib',
					'coordinate'	=> [
						'lat'	=> 37.78825,
						'lng'	=> -122.4324
					]
				]
			]
		];

		echo json_encode( $data );

	}

}