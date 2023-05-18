不具合の原因は、masterブランチが最新状態になっていなかったからです。以下の手順で作業してください。

1. GitHubでプルリクエスト（issue/3 -> master）を作成して、masterブランチにマージを行ってください。（プルリクエストは、GitLabでいうところのマージリクエストです）
2. PowerShellを立ち上げて、SSHでConhaWingに接続してください。
3. ```cd ~/laravel_projects/micro_blog```で、micro_blogディレクトリに移動してください。
4. ```git pull origin master```でmasterブランチを最新状態にしてください。

以上です。これで、urlにドメインを入力して、トップページが表示されたらOKです。
