<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle quiz submission
    $answers = $_POST;
    $counters = ['a' => 0, 'b' => 0, 'c' => 0];

    foreach ($answers as $answer) {
        if (isset($counters[$answer])) {
            $counters[$answer]++;
        }
    }

    // Determine the result
    arsort($counters);
    $highest = array_keys($counters, max($counters));

    if (in_array('a', $highest) && in_array('b', $highest)) {
        $result = "Self-Awareness: You are conscious of your own character, feelings, motives, and desires.";
    } elseif ($highest[0] == 'a') {
        $result = "Empathy: You see yourself in someone else’s situation before doing decisions.";
    } elseif ($highest[0] == 'b') {
        $result = "Self-Management: You manage yourself well.";
    } else {
        $result = "Curiosity: You excel in exploring the unknown.";
    }

    // Display result
    echo "<h1>Your Result</h1>";
    echo "<p>$result</p>";
    echo '<a href="?">Take the quiz again</a>';
    exit;
}

// Quiz questions
$questions = [
    1 => [
        "You went to a party last night and when you arrived at school the next day, everybody is talking about something you didn’t do. What will you do?",
        "a" => "Avoid everything and go with your friends",
        "b" => "Go and talk with the person that started the rumors",
        "c" => "Go and talk with the teacher"
    ],
    2 => [
        "What quality do you excel the most?",
        "a" => "Empathy",
        "b" => "Curiosity",
        "c" => "Perseverance"
    ],
    3 => [
        "You are walking down the street when you see an old lady trying to cross, what will you do?",
        "a" => "Go and help her",
        "b" => "Go for a policeman and ask him to help",
        "c" => "Keep walking ahead"
    ],
    4 => [
        "You had a very difficult day at school, you will maintain a __ attitude",
        "a" => "Depends on the situation",
        "b" => "Positive",
        "c" => "Negative"
    ],
    5 => [
        "You are at a party and a friend of yours comes over and offers you a drink, what do you do?",
        "a" => "Say no thanks",
        "b" => "Drink it until it is finished",
        "c" => "Ignore him and get angry at him"
    ],
    6 => [
        "You just started in a new school, you will...",
        "a" => "Go and talk with the person next to you",
        "b" => "Wait until someone comes over you",
        "c" => "Not talk to anyone"
    ],
    7 => [
        "In a typical Friday, you would like to...",
        "a" => "Go out with your close friends to eat",
        "b" => "Go to a social club and meet more people",
        "c" => "Invite one of your friends to your house"
    ],
    8 => [
        "Your relationship with your parents is...",
        "a" => "I like both equally",
        "b" => "I like both equally",
        "c" => "I like my Mom the most"
    ]
];
shuffle($questions);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality Quiz</title>
</head>
<body>
    <h1>Personality Quiz</h1>
    <form method="POST">
        <?php foreach ($questions as $id => $question): ?>
            <p><strong><?= $question[0]; ?></strong></p>
            <?php foreach (['a', 'b', 'c'] as $key): ?>
                <label>
                    <input type="radio" name="q<?= $id; ?>" value="<?= $key; ?>" required>
                    <?= $question[$key]; ?>
                </label><br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
