<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Notendur
        \App\User::create([
            'name' => 'Netvistun',
            'email' => 'vinna@netvistun.is',
            'password' => bcrypt(env('NETVISTUN')),
            'remember_token' => str_random(10),
        ]);

        $json = file_get_contents('http://girding.is/_json_export/');
        
        $items = json_decode($json, true);

        $fyrirtaekid = factory(\App\Page::class)->create([
                'title' => 'Fyrirtækið',
                'slug' => 'fyrirtaekid',
                'content' => '
                    <p>Öryggisgirðingar ehf. bjóða fjölbreytt úrval af girðingarefni og hliðum, m.a. vörur frá hollensku fyrirtækjunum Hop fencing og Deciwand sem framleiða m.a. grindargirðingar oig hlið, franska fyrirtækinu DIRICKX sem býður allar tegundir af girðingum og hliðum, og danska fyrirtækinu KIBO-SYSTEM sem býður alhliða lausnir í hliðum og aðgangskerfum. Enska fyrirtækinu Zaun sem framleiðir grindur eftir málum eða hönnun, og bjóða svokallaðar hljóðlausar girðingar sem henta vel fyrir íþróttavelli. Öryggisgirðingar eru með umboð fyrir vörum frá alþjóða fyrirtækinu CAME sem framleiðir alhliða aðgangslausnir. Öryggisgirðingar ehf bjóða einnig uppá fjölbreytta járnsmíðavinnu.</p>

                    <h3>Öryggisgirðingar ehf</h3>
                    <ul>
                        <li>Kt. 450503-3390</li>
                        <li>Suðurhraun 2</li>
                        <li>210 Garðabær</li>
                        <li>Sími 544 4222</li>
                        <li>Fax 544 4221</li>
                        <li><a href="mailto:girding@girding.is">girding@girding.is</a></li>
                    </ul>
                ',
                'images' => [],
                'files' => [],
            ]);


        factory(\App\Page::class)->create([
                'title' => 'Unnin verk',
                'slug' => 'unnin-verk',
                'content' => '
                    myndir hér
                ',
                'images' => [],
                'files' => [],
            ]);
        
        factory(\App\Page::class)->create([
                'title' => 'Íslensk framleiðsla',
                'slug' => 'islensk-framleidsla',
                'content' => '
                    efni hér
                ',
                'images' => [],
                'files' => [],
            ]);

        factory(\App\Page::class)->create([
                'title' => 'Fréttir',
                'slug' => 'frettir',
                'content' => '
                    efni hér
                ',
                'images' => [],
                'files' => [],
            ]);

        factory(\App\Page::class)->create([
                'title' => 'Vörur',
                'slug' => 'vorur',
                'content' => '
                ',
                'images' => [],
                'files' => [],
            ]);

        factory(\App\Page::class)->create([
                'title' => 'Hafa samband',
                'slug' => 'hafa-samband',
                'content' => '
                ',
                'images' => [],
                'files' => [],
            ]);














        factory(\App\Category::class)->create([
                'title' => 'Vörur',
                'slug' => 'vorur',
                'content' => '',
                'images' => [],
                'files' => [],
            ]);

        factory(\App\Category::class)->create([
                'title' => 'Produkter',
                'slug' => 'produkter',
                'content' => '',
                'images' => [],
                'files' => [],
            ]);

        $url = 'http://girding.is';

        function get_http_response_code($url) {
            $headers = get_headers($url);
            return substr($headers[0], 9, 3);
        }

        foreach($items as $item) {
            foreach($item['images'] as $image) {
                $newPath = public_path().'/uploads/'.$image['name'];
                $oldPath = $url.'/images/sent/'.$image['name'];

                if(!file_exists($newPath)) {
                    if(get_http_response_code($oldPath) == "200"){
                        $img = file_get_contents($url.'/images/sent/'.$image['name']);
                        file_put_contents(public_path().'/uploads/'.$image['name'], $img);
                    }
                }
            }

            factory(\App\Category::class)->create([
                'id'            => $item['id'],
                'title'         => $item['title'],
                'slug'          => strtolower(str_slug($item['title'], '-')),
                'status'        => $item['status'],
                'content'       => $item['content'],
                'images'        => $item['images'],
                'files'         => $item['files'],
                'parent_id'     => $item['parent_id'],
            ]);

            if(array_key_exists('products', $item) && !empty($item['products'])) {
                $skip = [];

                foreach($item['products'] as $product) {
                    foreach($product['images'] as $key => $image) {
                        $newPath = public_path().'/uploads/'.$image['name'];
                        $oldPath = $url.'/images/sent/'.$image['name'];

                        if(!file_exists($newPath)) {
                            if(get_http_response_code($oldPath) == "200"){
                                $img = file_get_contents($oldPath);
                                file_put_contents($newPath, $img);
                            } else {
                                $skip[] = $key;
                            }
                        }
                    }

                    $_images = [];

                    foreach($product['images'] as $k => $v) {
                        if( ! in_array($k, $skip)) {
                            $_images[] = $v;
                        }
                    }

                    //print_r($_images);

                    foreach($product['files'] as $file) {
                        $newPath = public_path().'/files/'.$file['name'];
                        $oldPath = $url.'/files/'.$file['name'];

                        if(!file_exists($newPath)) {
                            if(get_http_response_code($oldPath) == "200"){
                                $_file = file_get_contents($oldPath);
                                file_put_contents($newPath, $_file);
                            }
                        }
                    }

                    factory(\App\Product::class)->create([
                        'id'            => $product['id'],
                        'title'         => $product['title'],
                        'slug'          => strtolower(str_slug($product['title'], '-')),
                        'status'        => $product['status'],
                        'content'       => $product['content'],
                        'images'        => $_images,
                        'files'         => $product['files'],
                        'category_id'   => $product['category_id'],
                    ]);
                }
            }
        }

        Model::reguard();

        $fyrirtaekid = getContentBySlug('fyrirtaekid');

        $fyrirtaekid->translations('no')->add('content', '
        <p>Tilbyr totalløsning på sikkerhetsgjerder, panelgjerder, selvbærende elektriske porter, overvåking og oppsetning.</p>
        <p>Firmaets mål er å tilby våre kunder total løsning på Deres behov for områdesikring. Vi skal levere ferdig oppsatte, driftsklare systemer som våre kunder er fornøyde med.</p>

        <h3>Sikkerhetsgjerder AS</h3>
        <ul>
            <li>Tomteråsveien 23</li>
            <li>2165 Hvam</li>
            <li>Tlf: 99 11 42 22</li>
            <li>post@sikkerhetsgjerder.no</li>
        </ul>');

        $fyrirtaekid->translations('no')->add('title', 'Firma');
        $fyrirtaekid->translations('is')->add('title', 'Fyrirtækið');

        $fyrirtaekid->translations('is')->add('slug', 'fyrirtaekid');
        $fyrirtaekid->translations('no')->add('slug', 'firma');

        $fyrirtaekid->translations('is')->add('content', '
        <p>Öryggisgirðingar ehf. bjóða fjölbreytt úrval af girðingarefni og hliðum, m.a. vörur frá hollensku fyrirtækjunum Hop fencing og Deciwand sem framleiða m.a. grindargirðingar oig hlið, franska fyrirtækinu DIRICKX sem býður allar tegundir af girðingum og hliðum, og danska fyrirtækinu KIBO-SYSTEM sem býður alhliða lausnir í hliðum og aðgangskerfum. Enska fyrirtækinu Zaun sem framleiðir grindur eftir málum eða hönnun, og bjóða svokallaðar hljóðlausar girðingar sem henta vel fyrir íþróttavelli. Öryggisgirðingar eru með umboð fyrir vörum frá alþjóða fyrirtækinu CAME sem framleiðir alhliða aðgangslausnir. Öryggisgirðingar ehf bjóða einnig uppá fjölbreytta járnsmíðavinnu.</p>

        <h3>Öryggisgirðingar ehf</h3>
        <ul>
            <li>Kt. 450503-3390</li>
            <li>Suðurhraun 2</li>
            <li>210 Garðabær</li>
            <li>Sími 544 4222</li>
            <li>Fax 544 4221</li>
            <li><a href="mailto:girding@girding.is">girding@girding.is</a></li>
        </ul>');


        $hafasamband = getContentBySlug('hafa-samband');

        $hafasamband->translations('no')->add('content', '');

        $hafasamband->translations('no')->add('title', 'Ta kontakt');
        $hafasamband->translations('is')->add('title', 'Hafa samband');

        $hafasamband->translations('no')->add('slug', 'ta-kontakt');
        $hafasamband->translations('is')->add('slug', 'hafa-samband');


        $hafasamband->translations('is')->add('content', '');


        $vorur = getContentBySlug('vorur');
        $vorur->translations('no')->add('content', '');
        $vorur->translations('no')->add('title', 'Produkter');
        $vorur->translations('is')->add('title', 'Vörur');
        $vorur->translations('no')->add('slug', 'produkter');
        $vorur->translations('is')->add('slug', 'vorur');
        $vorur->translations('is')->add('content', '');
    }
}