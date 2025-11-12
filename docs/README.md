# McpModuleApi

[a-blog cms MCPサーバー](https://github.com/appleple/acms-mcp-server) 用のモジュール情報を提供するAPIを追加するプラグインです

## 動作環境

- a-blog cms: Ver. 3.2 (3.3+ not tested yet)
- php: 8.1 – 8.4 (8.5+ not tested yet)

## ダウンロード

<https://github.com/appleple/acms-mcp-module-api/raw/refs/heads/main/build/McpModuleApi.zip>


## インストール方法

拡張アプリをダウンロード後、zip ファイルを解凍して `extension/plugins/` に設置します。

設置が完了すると、「管理画面->拡張アプリ」に `McpModuleApi` という名前で本拡張アプリが表示されるので、インストールをクリックしインストールします。

## 設定

MCPで利用する、以下モジュールIDを作成します。作成するモジュールIDは、 **APIでの取得を許可** にチェックを入れてください。

### モジュールID一覧取得API

- **モジュール名**: V2_ModuleMeta_Index
- **モジュールID**: mcp_modules
- **説明**: モジュール一覧取得用API
- **引数**: なし

#### モジュールID詳細取得API

- **モジュール名**: V2_ModuleMeta_Detail
- **モジュールID**: mcp_module_detail
- **説明**: モジュール詳細取得用API
- **引数**: なし
