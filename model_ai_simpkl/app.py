from flask import Flask, request, jsonify
import joblib
import pandas as pd
import traceback

app = Flask(__name__)

# 1. Memuat (Loading) Otak AI dan Kamus saat server menyala
print("Memuat model AI...")
try:
    rf_model = joblib.load('random_forest_model.pkl')
    le_perusahaan = joblib.load('le_perusahaan.pkl')
    le_jurusan = joblib.load('le_jurusan.pkl')
    le_target = joblib.load('le_target.pkl')
    print("Model AI berhasil dimuat! Server siap menerima permintaan.")
except Exception as e:
    print(f"Gagal memuat model: {e}")

# 2. Membuat Jalur Komunikasi (Endpoint)
@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json()
        
        lama_pkl = int(data['lama_pkl'])
        # Tambahkan .strip() untuk membuang spasi gaib di awal/akhir kata
        nama_perusahaan = str(data['nama_perusahaan']).strip()
        jurusan = str(data['jurusan']).strip()
        
        # --- PROSES IMUNISASI TINGKAT TINGGI (TRY-EXCEPT) ---
        
        # 1. Menerjemahkan Perusahaan
        try:
            perusahaan_encoded = le_perusahaan.transform([nama_perusahaan])[0]
        except ValueError:
            perusahaan_encoded = 0
            print(f"⚠ Perusahaan tak dikenali: '{nama_perusahaan}'. Menggunakan fallback 0.")
            
        # 2. Menerjemahkan Jurusan
        try:
            jurusan_encoded = le_jurusan.transform([jurusan])[0]
        except ValueError:
            jurusan_encoded = 0
            print(f"⚠ Jurusan tak dikenali: '{jurusan}'. Menggunakan fallback 0.")
            
        # ----------------------------------------------------
        
        # Menyusun data sesuai urutan belajar AI
        input_data = pd.DataFrame([[lama_pkl, perusahaan_encoded, jurusan_encoded]], 
                                  columns=['Lama_PKL_Bulan', 'Nama_Perusahaan', 'Jurusan'])
        
        # AI Melakukan Prediksi
        prediksi_angka = rf_model.predict(input_data)[0]
        
        # Menerjemahkan kembali Angka ke Teks
        prediksi_teks = le_target.inverse_transform([prediksi_angka])[0]
        
        return jsonify({
            'status': 'success',
            'prediksi': prediksi_teks
        })

    except Exception as e:
        print(traceback.format_exc())
        return jsonify({
            'status': 'error',
            'message': str(e)
        }), 400

if __name__ == '__main__':
    app.run(debug=True, port=5000)