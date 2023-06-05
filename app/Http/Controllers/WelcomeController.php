<?php

namespace App\Http\Controllers;


class WelcomeController extends Controller
{
    //
    public function index()
    {
        //
        return redirect()->route('login');
        $data['title'] = config('app.name', 'Laravel');
        $data['header_name'] = "POLICE TRAINING CENTER";
        $data['banner_h1'] = "Bangladesh Police Training Center";
        $data['banner_h2'] = "Training Budget Management System";
        $data['about_img'] = asset('site/assets/img/about.jpg');
        $data['about'] =
<<<EOT
                    <h3>About Us</h3>
                    <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                    </ul>
                    <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
                    </p>
EOT;
        $data['police_logos_path']="site/assets/img/slide/";
        $data['police_logos']=array("a1.png", "a2.png", "a3.png", "a4.png", "a5.png", "a6.png");

        $data['mid_part']=array();
        $data['mid_part']['img']=asset('site/assets/img/features_2.jpeg');
        $data['mid_part']['data']=array();
        $data['mid_part']['data'][0]['icon']="bx bx-receipt";
        $data['mid_part']['data'][0]['title']="Est labore ad";
        $data['mid_part']['data'][0]['paragraph']="Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip";
        $data['mid_part']['data'][1]['icon']="bx bx-cube-alt";
        $data['mid_part']['data'][1]['title']="Harum esse qui";
        $data['mid_part']['data'][1]['paragraph']="Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt";
        $data['mid_part']['data'][2]['icon']="bx bx-images";
        $data['mid_part']['data'][2]['title']="Aut occaecati";
        $data['mid_part']['data'][2]['paragraph']="Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere";
        $data['mid_part']['data'][3]['icon']="bx bx-shield";
        $data['mid_part']['data'][3]['title']="Beatae veritatis";
        $data['mid_part']['data'][3]['paragraph']="Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta";

        $data['services']['slogan']="CHECK OUR SERVICES";
        $data['services']['data']=array();
        $data['services']['data'][0]['icon']="bx bxl-dribbble";
        $data['services']['data'][0]['title']="Lorem Ipsum";
        $data['services']['data'][0]['paragraph']="Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi";
        $data['services']['data'][1]['icon']="bx bx-file";
        $data['services']['data'][1]['title']="Sed ut perspiciatis";
        $data['services']['data'][1]['paragraph']="Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore";
        $data['services']['data'][2]['icon']="bx bx-tachometer";
        $data['services']['data'][2]['title']="Magni Dolores";
        $data['services']['data'][2]['paragraph']="Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia";
        $data['services']['data'][3]['icon']="bx bx-world";
        $data['services']['data'][3]['title']="Nemo Enim";
        $data['services']['data'][3]['paragraph']="At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis";
        $data['services']['data'][4]['icon']="bx bx-slideshow";
        $data['services']['data'][4]['title']="Dele cardo";
        $data['services']['data'][4]['paragraph']="Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur";
        $data['services']['data'][5]['icon']="bx bx-arch";
        $data['services']['data'][5]['title']="Divera don";
        $data['services']['data'][5]['paragraph']="Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur";

        $data['contact']['slogan']="Contact Us";
        $data['contact']['location']="Bangladesh";
        $data['contact']['email']="info@example.com";
        $data['contact']['call']="+880177777777";

        return view('welcome',$data);
    }
}
