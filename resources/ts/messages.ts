import { LocaleMessages } from 'vue-i18n';

export const messages: LocaleMessages = {
    ja: {
      layout: {
        actions: {
          top: 'トップ',
          event: 'イベント一覧',
          scheme: 'イベント応募',

          login: 'ログイン',
          menu: 'メニュー',
          logout: 'ログアウト',

          admin: '管理画面',
          twitter: 'Twitterクライアント',
        }
      },
      generals: {
        required: '* 必須',
        back: '戻る',
      },
      event: {
        labels: {
          oengus: 'イベントページ（Oengus）',
          submission: '応募リスト',
          schedule: 'スケジュール',
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
      submission: {
        labels: {
          loading: '募集内容を読み込んでいます。',
          games: {
            name: 'ゲーム',
            runner: '走者',
            console: '機種',
            ratio: '画面サイズ',
            description: 'ゲーム説明'
          },
          categories: {
            name: 'カテゴリー',
            type: '種別',
            estimate: '予定時間',
            description: 'カテゴリ説明'
          },
        },
        line: {
          type: {
            single: '単走',
            race: 'レース',
            coop: '協力',
            coop_race: '協力レース',
            other: 'その他'
          },
          status: {
            validated: '当選',
            todo: '未設定',
            bonus: 'ボーナス',
            backup: 'バックアップ',
            rejected: '落選',
          }
        }
      },
      twitter: {
        labels: {
          list: 'ツイート一覧',
          input: 'ツイート投稿',
          media: '画像を追加（4ファイルまで）',
          hashtag: 'ハッシュタグを選択',
        },
        actions: {
          post: '投稿',
          update: '更新',
          delete: '削除',
        }
      },
      stream: {
        internal: {
          title: '{name} の配信視聴ページ（OME用）',
        },
        errors: {
          html5: 'お使いのブラウザはHTML5のプレイヤーに対応していないため、再生できません。',
        }
      },
      scheme: {
        labels: {
          start: {
            date: 'イベント開始日',
            time: 'イベント開始時刻',
          },
          end: {
            date: 'イベント終了日',
            time: 'イベント終了時刻',
          },
          name: 'イベント名',
          explanation: 'イベント説明',
          apply: '応募',
          edit: {
            label: '編集',
            rule: '「応募済」状態の応募内容のみ編集が可能です。',
          },
        },
        links: {
          apply: '応募する',
        },
        details: {
          time: 'hhmm形式で入力してください。',
          name: 'イベント名を記入してください。仮のものでも構いません。',
          explanation: '応募するイベントについての説明を具体的に記入してください。'
        },
        errors: {
          time: {
            format: 'hhmm形式で入力してください。',
            hour: '時は0～23の値で入力してください。',
            minute: '分は0～59の値で入力してください。',
          }
        },
        status: {
          applied: '応募済',
          approved: '承認',
          confirmed: '確定',
          denied: '否認',
        },
        messages: {
          auth: 'イベント応募するにはログインしてください。',
        },
      },
      admin: {
        tabs: {
          role: '権限管理',
          event: 'イベント管理',
          scheme: 'イベント応募',
        },
        labels: {
          twitter: 'Twitter運用',
          admin: '管理者',
          internalStream: 'イベント用配信視聴',
          event: {
            import: 'イベントインポート'
          },
          scheme: {
            switches: {
              denied: '否認された応募を表示',
            },
            actions: {
              approve: '承認',
              deny: '否認',
              confirm: '確定',
            },
            name: 'イベント名',
            planner: '応募者',
            start: '予定開始日時',
            end: '予定終了日時',
            explanation: 'イベント説明',
            detail: '詳細',
          },
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
          admin: 'OME Portalの操作権限を管理を担当します。',
          internalStream: 'OMEで利用するイベント用の配信が確認できます。'
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
