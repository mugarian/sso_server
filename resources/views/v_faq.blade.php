@extends('layouts.portal')
@section('container')
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800 text-center my-4">Frequently Ask Question</h1>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
            {{ session('fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pertanyaan</h6>
                <a href="/login" class="m-0 text-primary">&lt; Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <div class="accordion text-black" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apa Itu Sistem SSO Polsub?
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            Sistem SSO Polsub merupakan sebuah website sentraliasasi login sistem-sistem Polsub yang
                            dibangun untuk memudahkan Civitas Akademika Polsub dalam mengakses semua Sistem Polsub hanya
                            dengan sekali login dengan satu akun.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Siapa saja yang dapat mengakses Sistem SSO Polsub?
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Sistem ini diperuntukkan bagi tenaga pendidik dan kependidikan seperti staf, dosen, dan
                            mahasiswa
                            yang berstatus aktif atau masih menjalankan perkuliahan di Politeknik Negeri Subang.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Seberapa Aman Sistem SSO Polsub?
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Sistem ini menggunakan Oauth2 sebagai otentikasi sistem yang berbasis JWT Token.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Siapa yang mengelola dan bertanggung jawab pada Sistem SSO?
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            Sistem SSO Polsub dikelola oleh UPT TIK Politeknik Negeri Subang.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Bagimana Cara Menghubungkan Sistem yang telah dibuat ke Sistem SSO Polsub?
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            Dengan cara menghubungi Admin UPT TIK untuk mendaftarkan sistem (client) ke Sistem SSO Polsub
                            untuk diberikan <code>ID Client</code> dan <code>Secret Code Client</code> sebagai syarat untuk
                            dihubungkan validasi Sistem SSO Polsub.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                aria-controls="collapseSix">
                                Apa saja yang perlu disiapkan untuk validasi Sistem SSO Polsub?
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <div>1. Mendaftarkan Sistem (Client) di Sistem SSO Polsub</div>
                            <div>2. Membuat Controller AuthController </div>
                            <div>3. Membuat Fungsi getLogin pada AuthController </div>
                            <pre>
public function getLogin() {
    $query = http_build_query(array(
        'client_id' => '', //ID Client yang terdaftar
        'redirect_uri' => 'http://example.com/callback.php', //url function callback pada sistem (client)
        'response_type' => 'code',
        'scope' => 'view-user',
        'prompt' => '',
    ));
    header('Location: http://localhost:8000/oauth/authorize?' . $query); //return url function authorize pada sistem SSO
}
                            </pre>
                            <div>4. Membuat fungsi callback pada AuthController</div>
                            <pre>
public function callback() {
    if (isset($_REQUEST['code']) && $_REQUEST['code']) {
        $ch = curl_init();
        $url = 'http://localhost:8000/oauth/token'; //url generate token sistem SSO
        $params = array(
            'grant_type' => 'authorization_code',
            'client_id' => '', //ID Client yang terdaftar
            'client_secret' => '', //Secret Code Client yang terdaftar
            'redirect_uri' => 'http://example.com/callback.php', //uri function callback sistem (client)
            'code' => $_REQUEST['code']
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $params_string = '';
        if (is_array($params) && count($params)) {
            foreach ($params as $key => $value) {
                $params_string .= $key . '=' . $value . '&';
            }
            rtrim($params_string, '&');
            curl_setopt($ch, CURLOPT_POST, count($params));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result);

        if (isset($response->access_token) && $response->access_token) {
            $access_token = $response->access_token;
            $ch = curl_init();
            $url = 'http://localhost:8000/api/user';
            $header = array(
                'Authorization: Bearer ' . $access_token
            );
            $query = http_build_query(array('uid' => '1'));
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $query);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $result = curl_exec($ch);
            curl_close($ch);

            // object
            $response = json_decode($result);

            // array
            $user = json_decode(json_encode($response), true);

            //URI function connectuser sistem (client)
            header('Location: http://example.com/connectuser.php?user=' . urlencode(serialize($user)));
        } else {
            var_dump('Login gagal');
        }
    }
}
                            </pre>
                            <div>4. Membuat fungsi connectUser pada AuthController</div>
                            <pre>
public function connectUser() {
    $userArray=unserialize(urldecode($_GET['user']));
    var_dump($userArray);
}
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/javascript");
    </script>
    <!-- DataTales Example -->
@endsection
