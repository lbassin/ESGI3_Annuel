<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo Helpers::getThemeAsset('css/survey.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Survey</title>
</head>
<body>
<div class="container">
    <div class="survey-container">
        <form action="" method="post">
            <div class="survey-title">
                <p>Question ?</p>
            </div>
            <div class="survey-answer">
                <p>Réponse A : <input type="radio" name="answer"></p>
                <div class="survey-progress"></div>

            </div>
            <div class="survey-answer">
                <p>Réponse B : <input type="radio" name="answer"></p>
                <div class="survey-progress"></div>
            </div>
            <div class="survey-answer">
                <p>Réponse C : <input type="radio" name="answer"></p>
                <div class="survey-progress"></div>
            </div>
            <div class="survey-submit">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>