<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body, h1, h2, p, a, input, button {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
        }

        body {
            background-color: #f4f7fc;
            color: #333;
        }


        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.8em;
        }


        main {
            text-align: center;
            margin-top: 100px;
            padding: 0 20px;
        }

        main h2 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
        }

        main p {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 40px;
        }

        .login-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: inline-block;
            max-width: 400px;
            width: 100%;
        }

        .login-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .login-form button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.4em;
            }

            main h2 {
                font-size: 2em;
            }

            .login-form {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>EventSite</h1>
    </header>

    <main>
        <h2>Bienvenue sur notre site web !</h2>
        <p>Nous sommes ravis de vous accueillir. Veuillez vous connecter pour accéder à nos services.</p>

        <div class="login-form">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <input type="email" name="email" placeholder="Entrez votre email" required>

                <input type="password" name="password" placeholder="Entrez votre mot de passe" required>

                <button type="submit">Se connecter</button>
            </form>
        </div>
    </main>

</body>

</html>
