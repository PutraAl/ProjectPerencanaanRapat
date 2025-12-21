<?php
/**
 * SENDGRID EMAIL SERVICE - SIMPLE & RELIABLE
 * Setup: composer require sendgrid/sendgrid-php
 */

use SendGrid\Mail\Mail;
use SendGrid\Mail\To;

class SendGridService {
    private $apiKey;
    private $fromEmail = 'palamsyah130@gmail.com';
    private $fromName = 'Pengelolaan Rapat';
    
    /**
     * Constructor
     * @param string $apiKey SendGrid API Key
     */
    public function __construct($apiKey) {
        require_once __DIR__ . '/../vendor/autoload.php';
        $this->apiKey = $apiKey;
    }
    
    /**
     * Kirim email undangan rapat
     */
    public function kirimUndangan($email, $nama, $rapatData) {
        try {
            $mail = new Mail();
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->setSubject("📧 Undangan Rapat: " . $rapatData['judul']);
            $mail->addTo($email, $nama);
            
            $htmlContent = $this->templateUndangan($nama, $rapatData);
            $mail->addContent("text/html", $htmlContent);
            
            $sendgrid = new \SendGrid($this->apiKey);
            $response = $sendgrid->send($mail);
            
            // Status code 202 = berhasil
            if($response->statusCode() == 202) {
                error_log("[SendGrid] ✅ Email sent to $email");
                return true;
            } else {
                error_log("[SendGrid] ❌ Failed to send to $email. Status: " . $response->statusCode());
                return false;
            }
            
        } catch(\Exception $e) {
            error_log("[SendGrid] Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Kirim notifikasi peserta ditambahkan
     */
    public function kirimNotifikasiDitambahkan($email, $nama, $rapatData) {
        try {
            $mail = new Mail();
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->setSubject("✨ Anda Ditambahkan ke Rapat: " . $rapatData['judul']);
            $mail->addTo($email, $nama);
            
            $htmlContent = $this->templateDitambahkan($nama, $rapatData);
            $mail->addContent("text/html", $htmlContent);
            
            $sendgrid = new \SendGrid($this->apiKey);
            $response = $sendgrid->send($mail);
            
            if($response->statusCode() == 202) {
                error_log("[SendGrid] ✅ Notification sent to $email");
                return true;
            } else {
                error_log("[SendGrid] ❌ Failed to send notification to $email");
                return false;
            }
            
        } catch(\Exception $e) {
            error_log("[SendGrid] Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Template HTML: Undangan Rapat
     */
    private function templateUndangan($nama, $rapatData) {
        $tanggal = date('d F Y', strtotime($rapatData['tanggal']));
        $waktu = date('H:i', strtotime($rapatData['waktu']));
        $judul = $rapatData['judul'];
        $lokasi = $rapatData['lokasi'];
        $deskripsi = $rapatData['deskripsi'];
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #0066cc; color: white; padding: 20px; border-radius: 5px 5px 0 0; text-align: center; }
                .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 0 0 5px 5px; }
                .detail { margin: 15px 0; padding: 15px; background: white; border-left: 4px solid #0066cc; border-radius: 3px; }
                .label { font-weight: bold; color: #0066cc; display: block; margin-bottom: 5px; }
                .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📧 Undangan Rapat</h2>
                </div>
                
                <div class='content'>
                    <p>Yth. <strong>$nama</strong>,</p>
                    
                    <p>Anda diundang untuk menghadiri rapat berikut:</p>
                    
                    <div class='detail'>
                        <span class='label'>📌 Judul Rapat</span>
                        $judul
                    </div>
                    
                    <div class='detail'>
                        <span class='label'>📅 Tanggal</span>
                        $tanggal
                    </div>
                    
                    <div class='detail'>
                        <span class='label'>⏰ Waktu</span>
                        $waktu
                    </div>
                    
                    <div class='detail'>
                        <span class='label'>📍 Lokasi/Platform</span>
                        $lokasi
                    </div>
                    
                    <div class='detail'>
                        <span class='label'>📝 Deskripsi</span>
                        $deskripsi
                    </div>
                    
                    <p style='margin-top: 30px;'>
                        Mohon login ke aplikasi untuk mengkonfirmasi kehadiran Anda.
                    </p>
                    
                    <p>Terima kasih atas perhatian Anda.</p>
                    
                    <p style='margin-top: 30px;'>
                        <strong>Salam,<br>PBL-2 IF MALAM E :D</strong>
                    </p>
                </div>
                
                <div class='footer'>
                    <p>Email ini dikirim otomatis oleh sistem Meeting Kampus.</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
    
    /**
     * Template HTML: Peserta Ditambahkan
     */
    private function templateDitambahkan($nama, $rapatData) {
        $tanggal = date('d F Y', strtotime($rapatData['tanggal']));
        $waktu = date('H:i', strtotime($rapatData['waktu']));
        $judul = $rapatData['judul'];
        $lokasi = $rapatData['lokasi'];
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #00b359; color: white; padding: 20px; border-radius: 5px 5px 0 0; text-align: center; }
                .content { background: #f0fff4; padding: 20px; border: 1px solid #ddd; border-radius: 0 0 5px 5px; }
                .detail { margin: 15px 0; padding: 15px; background: white; border-left: 4px solid #00b359; border-radius: 3px; }
                .label { font-weight: bold; color: #00b359; display: block; margin-bottom: 5px; }
                .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>✨ Anda Ditambahkan ke Rapat</h2>
                </div>
                
                <div class='content'>
                    <p>Yth. <strong>$nama</strong>,</p>
                    
                    <p>Selamat! Anda telah ditambahkan sebagai peserta dalam rapat berikut:</p>
                    
                    <div class='detail'>
                        <span class='label'>📌 Judul Rapat</span>
                        $judul
                    </div>
                    
                    <div class='detail'>
                        <span class='label'>📅 Tanggal</span>
                        $tanggal
                    </div>
                    
                    <div class='detail'>
                        <span class='label'>⏰ Waktu</span>
                        $waktu
                    </div>
                    
                    <div class='detail'>
                        <span class='label'>📍 Lokasi/Platform</span>
                        $lokasi
                    </div>
                    
                    <p style='margin-top: 30px;'>
                        Silakan login ke aplikasi untuk mengkonfirmasi kehadiran Anda.
                    </p>
                    
                    <p>Terima kasih!</p>
                </div>
                
                <div class='footer'>
                    <p>Email ini dikirim otomatis. Jangan balas email ini.</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}

?>