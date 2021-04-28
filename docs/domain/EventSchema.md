# Event Schema (イベント応募について)

## Schema (イベント運営応募)

### description

- OMEで運営・開催したい応募.
- 採用された場合、応募者が主催・運営になります.

### models

|property|type|description|
|:--|:--|:--|
|名前|string|イベント名.|
|開始予定日時|Datetime|イベントの開始予定日時.|
|終了予定日時|Datetime|イベントの終了予定日時.|
|イベント説明|string|イベントの運営向け説明.|
|イベント詳細|string|イベントの詳細文.イベント参加者向けの文章で、応募時に参照する.|

## Plan (イベント案応募)

### description

- OME運営向けのイベント案応募.

### models

|property|type|description|
|:--|:--|:--|
|名前|string|イベント名.|
|イベント案説明|string|イベント案の運営向け説明.|
