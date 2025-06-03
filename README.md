## 如何啟動服務

1. 使用 `composer install` 安裝依賴
2. 將 `.env.example` 複製成 `.env`
3. 使用 `php artisan key:generate` 產生 `.env` 檔案的 `APP_KEY`
4. 使用 `php artisan serve` 啟動服務，預設會在 http://localhost:8000

## API 文檔

1. 透過 http://localhost:8000/docs/api 可以瀏覽 UI 文檔
2. 透過 http://localhost:8000/docs/api.json 可以取得 openapi 檔案
3. 專案 docs 資料夾內有 bruno 文檔可以匯入 bruno (類似 Postman)，匯入後右上角選擇 `local` 環境
