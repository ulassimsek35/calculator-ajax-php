# Ajax Calculator

## Açıklama / Description

Bu proje, Bootstrap kullanılarak oluşturulmuş kullanıcı arayüzüne sahip basit bir Ajax tabanlı hesap makinesidir. Kullanıcıların temel aritmetik işlemleri yapmasına ve hesaplamalarını bir veritabanında saklamasına olanak tanır.  
/  
This project is a simple Ajax-based calculator with a user interface built using Bootstrap. It allows users to perform basic arithmetic operations and save their calculations in a database.

## Kullanılan Teknolojiler / Technologies Used

- HTML
- CSS (Bootstrap)
- JavaScript (jQuery)
- PHP
- MySQL

## Kullanım / Usage

- `index.php` dosyasını tarayıcınızda açın.  
/  
  Open the `index.php` file in your browser.
- Temel aritmetik işlemlerini gerçekleştirmek için hesap makinesini kullanın.  
/  
  Use the calculator to perform basic arithmetic operations.
- Hesaplamanızı veritabanına kaydetmek için kaydet butonuna tıklayın.  
/  
  Click the save button to store your calculation in the database.

## Dosyalar / Files

### `index.php`

Ana hesap makinesi arayüzünü içerir ve veritabanından kaydedilen hesaplamaları çeker.  
/  
Contains the main calculator interface and fetches saved calculations from the database.

### `main.js`

Hesap makinesi işlemleri için gerekli olan JavaScript kodlarını içerir.  
/  
Contains the JavaScript code necessary for calculator operations.

### `calcusaver.php`

Hesaplama işlemlerini gerçekleştiren ve sonuçları veritabanına kaydeden PHP dosyası.  
/  
PHP file that performs calculations and saves results to the database.

### `conn.php`

Veritabanı bağlantı ayarlarını içerir.  
/  
Contains the database connection settings.

### `calculates.sql`

Veritabanı yapılandırma dosyası, hesaplama sonuçlarını saklamak için gerekli tabloyu oluşturur.  
/  
Database configuration file, creates the necessary table to store calculation results.
