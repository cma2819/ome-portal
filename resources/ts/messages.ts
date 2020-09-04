import { LocaleMessages } from 'vue-i18n';

export const messages: LocaleMessages = {
    ja: {
      layout: {
        actions: {
          top: 'トップ',

          login: 'ログイン',
          menu: 'メニュー',
          logout: 'ログアウト',

          admin: '管理画面',
          twitter: 'Twitterクライアント',
        }
      },
      twitter: {
        labels: {
          list: 'ツイート一覧',
          input: 'ツイート投稿',
          media: '画像を追加（4ファイルまで）',
        },
        actions: {
          post: '投稿',
          update: '更新',
          delete: '削除',
        }
      },
      admin: {
        tabs: {
          role: '権限管理',
          event: 'イベント管理',
        },
        labels: {
          twitter: 'Twitter運用',
          admin: '管理者',
          event: {
            import: 'イベントインポート'
          }
        },
        event: {
          headers: {
            import: 'イベントインポート',
            list: 'イベント一覧',
          },
          labels: {
            import: {
              input: 'ID',
              button: '取得',
              result: '取得結果',
            },
            preview: {
              id: 'ID',
              name: 'イベント名',
              start: '開始日時',
              end: '終了日時',
              relate: '関連',
              slug: 'slug（略称）',
              import: 'インポート',
            },
            edit: {
              edit: '変更',
              delete: '削除',
            }
          },
        },
        descriptions: {
          twitter: 'OMEアカウントからのTwitter投稿を担当します。',
          admin: 'OME Portalの操作権限を管理を担当します。'
        }
      }
    }
}
