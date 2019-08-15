<?php

declare(strict_types=1);

function printStartMessage(): void {
    print("======================================================\n");
    print("数当てゲームへようこそ！\n");
    print("数字は1から100までで構成されています。\n");
    print("======================================================\n");
}

function generateSecretNumber(int $max): int {
    $secret_number = rand(1, $max);
    return $secret_number;
}

function getInputFromUser(): int {
    while(true) {
        print("数字を入力してください >> ");
        $answer =trim(fgets(STDIN));
        if (!is_numeric($answer)) {
            print("無効な文字です！数字のみもう一度入力してください。\n");
        } else {
            return (int) $answer;
        }
    }
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

function selectKeepGameOrExit(string $choice): void {
    switch ($choice) {
        case 1:
            main();
        case 2:
            exit("また遊ぼうね！\n");
    }

}

function checkStartTimerIsOk(): void {
    while(true) {
        print("Enterを押すとタイマーが計測開始します。よろしければEnterを押してください\n");
        $isEnter = trim(fgets(STDIN));
        if (mb_strlen($isEnter) === 0) {
            break;
        }
    }
}

function main() {
    //ミス回数
    $mistakeCounter = 0;
    //答え生成
    $secret_number = generateSecretNumber(100);
    $startTime = 0;
    $endTime = 0;
    $resultTime = 0;
    //開始メッセージ出力
    printStartMessage();
    //タイマー開始の確認
    checkStartTimerIsOk();
    //タイマー開始
    $startTime = time();

    //正解まで繰り返す
    while(true) {
        //ユーザー入力を取得
        $answer = getInputFromUser();
        //合ってたら正解を、大きいか小さいならそれを。
        print("あなたの選択数字は" . $answer . "です。\n");

        //解答を比較。間違っていたらミス数をカウント
        if(compareAnswer($answer, $secret_number)) {
            //正解したら計測終了
            $endTime = time();
            break;
        } else {
            $mistakeCounter++;
        }
    }

    //プレイ時間を計測 ミリ秒から時間:分:秒に変換
    $resultTime = date("H時間i分s秒",$endTime-$startTime);
    print("\nタイム: " . $resultTime . "\n");
    print("試行回数: " . $mistakeCounter . "回\n");
    //もう一度するか聞く
    print("もう一度やりますか？下の数字から選択してください。\n");
    print("(1) もう一度やる\n(2) やめる\n>> ");
    $choice = trim(fgets(STDIN));
    //１なら続ける 2ならやめる
    selectKeepGameOrExit($choice);
}

main();
