    @extends('layouts.layout')

    @section('content')
        <h2>ma’lumotlarini tahrirlash</h2>

        <form action="{{ route('qizlar.update', $qiz) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>FIO:</label><br>
            <input type="text" name="fio" value="{{ old('fio', $qiz->fio) }}" required><br><br>

            <label>Sinf:</label><br>
            <input type="text" name="sinfi" value="{{ old('sinfi', $qiz->sinfi) }}"><br><br>

            <label>Yosh:</label><br>
            <input type="text" name="yoshi" value="{{ old('yoshi', $qiz->yoshi) }}"><br><br>

            <label>Manzil:</label><br>
            <input type="text" name="manzili" value="{{ old('manzili', $qiz->manzili) }}" required><br><br>

            <label>Rasm (agar o‘zgartirmoqchi bo‘lsangiz):</label><br>
            <input type="file" name="rasmi"><br><br>

            <button type="submit">Yangilash</button>
        </form>
@endsection()

    <style>
        /* 🌸 General page styling */
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #ffe6f2, #fff);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* 🌸 Container */
        form {
            background: #fff;
            max-width: 550px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 18px;
            box-shadow: 0 8px 22px rgba(139, 0, 93, 0.1);
        }

        /* 🌸 Heading */
        h2 {
            text-align: center;
            color: #b31f6f;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        /* 🌸 Label styling */
        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #8b005d;
        }

        /* 🌸 Input styling */
        form input[type="text"],
        form input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            transition: border 0.3s, box-shadow 0.3s;
            outline: none;
            background-color: #fafafa;
        }

        form input[type="text"]:focus,
        form input[type="file"]:focus {
            border-color: #b31f6f;
            box-shadow: 0 0 5px rgba(179, 31, 111, 0.4);
        }

        /* 🌸 Submit button */
        form button {
            display: block;
            width: 100%;
            margin-top: 1.5rem;
            background-color: #b31f6f;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 12px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        form button:hover {
            background-color: #8b005d;
            transform: translateY(-2px);
        }

        /* 🌸 Spacing between fields */
        form > *:not(:last-child) {
            margin-bottom: 1rem;
        }

        /* 🌸 Responsive design */
        @media (max-width: 600px) {
            form {
                padding: 1.2rem;
                margin: 1rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

    </style>
