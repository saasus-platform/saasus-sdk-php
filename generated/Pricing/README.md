# Pricing

詳細(引数、戻り値)は API ドキュメントを[参照](https://docs.saasus.io/reference/getpricingunits)

## プライシングユニット

- GetPricingUnits ・・・プライシングユニットの一覧を取得

- GetPricingUnit ・・・プライシングユニットを取得
- CreatePricingUnit ・・・プライシングユニットを作成

## 機能メニュー

- GetPricingMenus ・・・プライシング機能メニュー一覧を取得

- GetPricingMenu ・・・プライシング機能メニューを取得
- CreatePricingMenu ・・・プライシング機能メニューを作成

## 料金プラン

- GetPricingPlans ・・・料金プラン一覧を取得

- GetPricingPlan ・・・料金プランを取得
- CreatePricingPlan ・・・料金プランを作成

- DeleteAllPlansAndMenusAndUnitsAndMeters ・・・全ての Plans,Menus,Units,Meters の削除

## メータリング

- GetMeteringUnitDateCountByTenantIdAndUnitNameAndDate ・・・指定した日付のメータリングユニットカウントを取得
- UpdateMeteringUnitTimestampCount ・・・指定したタイムスタンプのメータリングユニットカウントを更新
- DeleteMeteringUnitTimestampCount ・・・指定したタイムスタンプのメータリングユニットカウントを削除

- GetMeteringUnitDateCountByTenantIdAndUnitNameToday ・・・当日のメータリングユニットカウントを取得
- UpdateMeteringUnitTimestampCountNow ・・・現在時刻のメータリングユニットカウントを更新

- GetMeteringUnitMonthCountByTenantIdAndUnitNameThisMonth ・・・当月のメータリングユニットカウントを取得
- GetMeteringUnitMonthCountByTenantIdAndUnitNameAndMonth ・・・指定月のメータリングユニットカウントを取得

- GetMeteringUnitDateCountsByTenantIdAndDate ・・・指定日の全メータリングユニットカウントを取得
- GetMeteringUnitMonthCountsByTenantIdAndMonth ・・・指定月の全メータリングユニットカウントを取得
