import { LocaleMessages } from 'vue-i18n';

export const messages: LocaleMessages = {
    ja: {
      layout: {
        actions: {
          top: 'トップ',
          schedule: 'スケジュール',

          login: 'ログイン',
          menu: 'メニュー',
          logout: 'ログアウト',

          admin: '管理画面',
          twitter: 'Twitterクライアント',
        }
      },
      event: {
        labels: {
          oengus: 'イベントページ（Oengus）',
          schedule: 'スケジュール'
        }
      },
      schedule: {
        labels: {
          loading: 'スケジュールを読み込んでいます。',
          date: '日付',
          time: '開始時間',
          runner: '走者',
          game: 'ゲーム',
          category: 'カテゴリー',
          type: '種別',
          console: '機種',
          estimate: '予定時間',
        },
        line: {
          type: {
            single: '単走',
            race: 'レース',
            coop: '協力',
            coop_race: '協力レース',
            other: 'その他'
          }
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
      },
      top: {
        event: {
          statuses: {
            submission: {
              open: '走者申請受付中'
            },
            selection: {
              confirmed: '作品選考済み',
              progress: '作品選考未完了',
              mobile: '選考'
            },
            schedule: {
              confirmed: 'スケジュール確定済み',
              progress: 'スケジュール未設定',
              mobile: 'スケジュール',
            },
            closed: 'イベント終了'
          }
        }
      }
    }
}
