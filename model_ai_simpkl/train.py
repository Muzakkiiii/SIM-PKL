import pandas as pd
import joblib
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier

print("1. Membaca dataset...")
df = pd.read_csv('data_dummy_simpkl.csv')

print("2. MEMBERSIHKAN SPASI GAIB...")
# Inilah kunci utamanya! Kita potong semua spasi ekstra di awal/akhir teks
df['Jurusan'] = df['Jurusan'].str.strip()
df['Nama_Perusahaan'] = df['Nama_Perusahaan'].str.strip()
df['Target_Kategori'] = df['Target_Kategori'].str.replace('SANGATKOMPETEN', 'SANGAT KOMPETEN').str.strip()

print("3. Mempersiapkan data untuk AI...")
X = df[['Lama_PKL_Bulan', 'Nama_Perusahaan', 'Jurusan']].copy()
y = df['Target_Kategori'].copy()

le_perusahaan = LabelEncoder()
X['Nama_Perusahaan'] = le_perusahaan.fit_transform(X['Nama_Perusahaan'])

le_jurusan = LabelEncoder()
X['Jurusan'] = le_jurusan.fit_transform(X['Jurusan'])

le_target = LabelEncoder()
y = le_target.fit_transform(y)

print("4. Melatih ulang model AI...")
# Kita gunakan setelan terbaik dari hasil tuning Google Colab kemarin
rf = RandomForestClassifier(max_depth=5, min_samples_split=2, n_estimators=100, random_state=42)
rf.fit(X, y)

print("5. Menyimpan 'Otak' dan 'Kamus' AI yang baru...")
joblib.dump(rf, 'random_forest_model.pkl')
joblib.dump(le_perusahaan, 'le_perusahaan.pkl')
joblib.dump(le_jurusan, 'le_jurusan.pkl')
joblib.dump(le_target, 'le_target.pkl')

print("BERHASIL! Model AI telah diperbarui dengan data yang bersih.")