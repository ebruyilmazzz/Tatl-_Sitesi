# Tatlı Tarifleri Web Sitesi

Bu proje, PHP ve MySQL kullanılarak geliştirilmiş basit bir tatlı tarifleri yönetim sistemidir. Kullanıcılar yeni tatlı tarifleri ekleyebilir, mevcut tarifleri listeleyebilir ve silebilir.

## Özellikler
- Tatlı tariflerini ekleme
- Eklenen tarifleri listeleme
- Tarifleri silme
- Basit bir yönetici paneli

## Kurulum

1. **XAMPP veya benzeri bir yerel sunucu** indirin ve kurun.
2. Proje dosyalarını `htdocs` klasörüne kopyalayın:
   ```
   c:/xampp/htdocs/ip2/tatli_tarifleri
   ```
3. MySQL veritabanınızı oluşturun ve gerekli tabloları ekleyin. Aşağıda örnek bir tablo yapısı verilmiştir:
   ```sql
   CREATE DATABASE tatli_tarifleri;
   USE tatli_tarifleri;

   CREATE TABLE tarifler (
       id INT AUTO_INCREMENT PRIMARY KEY,
       isim VARCHAR(255) NOT NULL,
       malzemeler TEXT NOT NULL,
       tarif TEXT NOT NULL
   );
   ```
4. `baglanti.php` dosyasında veritabanı bağlantı bilgilerinizi güncelleyin.
5. XAMPP üzerinden Apache ve MySQL servislerini başlatın.
6. Tarayıcınızda `http://localhost/ip2/tatli_tarifleri` adresine gidin.

## Kullanım
- Yeni tarif eklemek için `ekle.php` dosyasını kullanabilirsiniz.
- Tarifleri listelemek ve silmek için `liste.php` dosyasını kullanın.
- Yönetici işlemleri için `admin.php` dosyasını kullanabilirsiniz.

## Katkıda Bulunma
Pull request'ler ve öneriler memnuniyetle karşılanır. Lütfen önce bir issue açınız.

## Lisans
Bu proje MIT lisansı ile lisanslanmıştır.
<hr>
![image](https://github.com/user-attachments/assets/8ac6a6ad-0a9f-4ce4-958a-37914897efb0)
![image](https://github.com/user-attachments/assets/84df45c0-aec6-499d-b590-94cd7dc90e7a)
![image](https://github.com/user-attachments/assets/11024255-956a-441c-8e8b-
![image](https://github.com/user-attachments/assets/6657d3d8-f558-4b85-b24c-b7161b8b7db5)
a2a31b9e7664)
