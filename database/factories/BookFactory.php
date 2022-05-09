<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use App\Enums\DBConstant;

$factory->define(App\Models\Book::class, function (Faker $faker) {
    static $uid = 143;
    static $images = [
        "https://images.pexels.com/photos/6353764/pexels-photo-6353764.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260",
        "https://images.pexels.com/photos/7708560/pexels-photo-7708560.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/7889083/pexels-photo-7889083.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/3078831/pexels-photo-3078831.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/904620/pexels-photo-904620.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/2228586/pexels-photo-2228586.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/3518091/pexels-photo-3518091.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/256450/pexels-photo-256450.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/4218711/pexels-photo-4218711.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/3622632/pexels-photo-3622632.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/4857773/pexels-photo-4857773.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/5095897/pexels-photo-5095897.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://images.pexels.com/photos/2090104/pexels-photo-2090104.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260",
        "https://i.pinimg.com/564x/97/ef/81/97ef813fee1d921354b7ea91c5af7e53.jpg",
        "https://i.pinimg.com/originals/76/2e/44/762e440516cdc793eb14947f8691841e.jpg",
        "https://i.pinimg.com/564x/5c/16/05/5c160583634b4f7172dbbd6899d256e4.jpg",
        "https://i.pinimg.com/564x/35/7d/d9/357dd9ba50e22152672b826ebc3a4afa.jpg",
        "https://i.pinimg.com/564x/0d/a2/02/0da202c46a383f8009d9635d3918c92d.jpg",
        "https://i.pinimg.com/564x/aa/da/f2/aadaf285bd353258d793892166b0b433.jpg",
        "https://i.pinimg.com/564x/e8/84/83/e88483e9cbb5bc6b067f37fbd291bef3.jpg",
        "https://i.pinimg.com/564x/0a/6d/d8/0a6dd810028dee62dba5109efdac03e4.jpg",
        "https://i.pinimg.com/564x/70/f7/e0/70f7e014f1484daa29e4ae214a10cc0c.jpg",
        "https://i.pinimg.com/564x/a9/f3/94/a9f39401be262376c87f5b4351555e90.jpg",
        "https://i.pinimg.com/564x/f9/69/c2/f969c21d2082cf83a61b6668fceb312a.jpg",
        "https://i.pinimg.com/564x/03/40/64/034064001bee35be94c16228884bf57b.jpg",
        "https://i.pinimg.com/564x/a1/e0/ef/a1e0ef09b278bf0669cc3198eb72fc82.jpg",
        "https://i.pinimg.com/564x/27/b8/be/27b8be3c577f0c07c5ff321afb328307.jpg",
        "https://i.pinimg.com/564x/3b/36/11/3b36110e2f4e8bd6b53670c6bba3660e.jpg",
        "https://i.pinimg.com/564x/34/0d/bd/340dbd5c4e0a3aa2ba4ac3303537761c.jpg",
        "https://i.pinimg.com/564x/95/26/2d/95262de6735527bf70d38cd163ea305f.jpg",
        "https://i.pinimg.com/564x/7b/83/88/7b838820617fd20cb79d21c15219b683.jpg",
        "https://i.pinimg.com/564x/74/ed/3b/74ed3b554061c9143ca47589015ae31a.jpg",
        "https://i.pinimg.com/564x/44/b6/cd/44b6cd4fced97694cc665a527b9bbb49.jpg",
        "https://i.pinimg.com/564x/fa/2e/42/fa2e42bc1162cabc5200afeca35eaf63.jpg",
        "https://i.pinimg.com/564x/65/ea/0f/65ea0fac269fcdf5c46978c2cb68be18.jpg",
        "https://i.pinimg.com/564x/c3/79/b3/c379b375f60487f01b3cf1f3a5ce5fa7.jpg",
        "https://i.pinimg.com/originals/ca/46/d8/ca46d8d0f39f2e2f076b8031fbb0c4b1.gif",
        "https://i.pinimg.com/564x/eb/24/1f/eb241f0473a65395d9f87db48c18acfe.jpg",
        "https://i.pinimg.com/564x/5e/d0/89/5ed089b26491949a201f20c1ce9c5f10.jpg",
        "https://i.pinimg.com/564x/ff/dc/c1/ffdcc16342e0f0ed81801d734559a153.jpg",
        "https://i.pinimg.com/564x/ef/2f/49/ef2f49e7c154895e611c4dbaa341c093.jpg",
        "https://i.pinimg.com/564x/87/6f/fc/876ffc9c154294ff93f05aadcfd45a3a.jpg",
        "https://i.pinimg.com/564x/c4/38/a6/c438a6409c8fe9bc62c81a986f9ec145.jpg",
        "https://i.pinimg.com/564x/5a/e6/d3/5ae6d35b01d82b351a940910cdc0f7be.jpg",
        "https://i.pinimg.com/564x/21/f3/e7/21f3e7a8c3d779423938fc9ff66faa33.jpg",
    ];
    static $books = [
        "https://pdfroom.com/embed/books/manga-comics-the-breaker-new-waves-2/qlgyyD8OgMG",
        "https://pdfroom.com/embed/books/manga-comics-the-breaker-new-waves-4/vxdzZPazdRV",
        "https://pdfroom.com/embed/books/manga-comics-the-breaker-new-waves-6/ZOgZoxny2kb",
        "https://pdfroom.com/embed/books/manga-comics-the-breaker-new-waves-3/on5bbBeJ56V",
        "https://pdfroom.com/embed/books/manga-comics-the-breaker-new-waves-1/o75XZeAegaG",
        "https://pdfroom.com/embed/books/manga-comics-reincarnated-marquis-1/PkdNLEVB2Xr",
        "https://pdfroom.com/embed/books/manga-comics-reincarnated-marquis-4/on5bbBrr56V",
        "https://pdfroom.com/embed/books/manga-comics-reincarnated-marquis-2/o75XZeqwgaG",
        "https://pdfroom.com/embed/books/manga-comics-reincarnated-marquis-5/vxdzZPjVdRV",
        "https://pdfroom.com/embed/books/manga-comics-reincarnated-marquis-3/qlgyyDNxgMG",
        "https://pdfroom.com/embed/books/manga-comics/qlgyyqrqgMG",
        "https://pdfroom.com/embed/books/manga-messiah/wW5mwXvjgYo",
        "https://pdfroom.com/embed/books/manga-in-theory-and-practice-the-craft-of-creating-manga/E1d4DOQPdOb",
        "https://pdfroom.com/embed/books/akamegakiru-v03-manga-comic/zk2Aqb4A2PJ",
        "https://pdfroom.com/embed/books/how-to-draw-manga/7jgkRzpedMV",
        "https://pdfroom.com/embed/books/american-comics-for-manga-fans/andLVnEQ2e3",
        "https://pdfroom.com/embed/books/paku-manga-science-vol-01/wW5mwQRwgYo",
        "https://pdfroom.com/embed/books/manga-mania-shonen-rpdf-download/7jgkRlM0dMV",
        "https://pdfroom.com/embed/books/como-dibujar-manga-1-personajes/MkLg8KkDdZB",
        "https://pdfroom.com/embed/books/manga-for-dummies-isbn-0470080256/NpgpZQoe5jr",
    ];

    $thumbnail_url = $images[$faker->numberBetween(0, count($images) - 1)];
    $ebook_url = $books[$faker->numberBetween(0, count($books) - 1)];
    $title = '';
    for ($i=1; $i < $faker->numberBetween(0, 50); $i++) { 
        $title = $title . $faker->firstName . $faker->lastName;
    }

    return [
        'user_id' =>  $uid++,
        'thumbnail_url' => $thumbnail_url,
        'ebook_url' => $ebook_url,
        'title' => $title,
        'is_hidden' => $faker->numberBetween(DBConstant::BOOKS_NOT_HIDDEN, DBConstant::BOOKS_IS_HIDDEN),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
