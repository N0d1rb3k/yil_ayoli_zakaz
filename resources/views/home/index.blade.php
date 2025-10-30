@extends('layouts.app')

@section('content')

    <nav>
        <a href="{{ route('qizlar.index') }}">Qizlar</a>

        <a href="#">Yutuqlar</a>
        <a href="#">Ovoz berish</a>
        <a href="#">Aloqa</a>
    </nav>

    <header>
        <h1>🌸 Yil Ayoli — Ilhom manbai bo‘lgan qizlar 🌸</h1>
    </header>

    <section>
        <h2>“Yil Ayoli” loyihasiga xush kelibsiz!</h2>
        <p>
            Maktabimizdagi iqtidorli, faol va ilhomlantiruvchi qizlarni birgalikda tanlaymiz!
        </p>
    </section>

    <section>
        <h3>Loyiha haqida</h3>
        <p>
            “Yil Ayoli” — bu maktabimizda o‘qiyotgan eng faol, ijodkor, mehribon va ilhomlantiruvchi qizlarni tanlash loyihasi.
            Har bir o‘quvchi bu jarayonda qatnashib, o‘z ovozini bera oladi.
            G‘olib esa yil yakunida “Yil Ayoli” unvoniga ega bo‘ladi!
        </p>

        <div>
            <a href="#">Nomzodlarni ko‘rish →</a>
        </div>
    </section>

    <footer>
        <p>© 2025 “Yil Ayoli” loyihasi. Barcha huquqlar himoyalangan.</p>
    </footer>

@endsection
