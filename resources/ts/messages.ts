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
        },
        labels: {
          twitter: 'Twitter運用',
          admin: '管理者',
        },
        descriptions: {
          twitter: 'OMEアカウントからのTwitter投稿を担当します。',
          admin: 'OME Portalの操作権限を管理を担当します。'
        }
      }
    }
}
