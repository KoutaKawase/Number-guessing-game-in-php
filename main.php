<?php

declare(strict_types=1);

function printStartMessage(): void {
    print("======================================================\n");
    print("数当てゲームへようこそ！\n");
    print("数字は1から100までで構成されています。\n");
}

function generateSecretNumber(int $max): int {
    $secret_number = rand(1, $max);
    return $secret_number;
}

function getInputFromUser(): int {
    print("数字を入力してください >> ");
    $answer = fgets(STDIN);

    return (int)$answer;
}

function compareAnswer(int $ans, int $secNum): bool {
    $isCorrect = False;
    if ($secNum < $ans) {
        print("大きいです！\n");
        $isCorrect = false;
        return $isCorrect;
    } else if ($secNum > $ans) {
        print("小さいです！\n");
        $isCorrect = false;
        return $isCorrect;
    } else {
        print("正解です！やったね！\n");
        $isCorrect = True;
        return $isCorrect;
    }
}

function main() {
    //開始メッセージ出力
    printStartMessage();
    print("======================================================\n");
    //答えを生成
    $secret_number = generateSecretNumber(100);
    //正解まで繰り返す
    while(true) {
        //ユーザー入力を取得
        $answer = getInputFromUser();
        //合ってたら正解を、大きいか小さいならそれを。
        print("あなたの選択数字は" . $answer . "です。\n");

        if(compareAnswer($answer, $secret_number)) {
            break;
        };
    }

    //もう一度するか聞く
    print("もう一度やりますか？下の数字から選択してください。\n");
    print("(1) もう一度やる\n(2) やめる\n>> ");
    $choice = fgets(STDIN);

    switch ($choice) {
        case 1:
            main();
        case 2:
            exit("また遊ぼうね！\n");
    }

}

main();
