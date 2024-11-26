<?php
// JSON fájl letöltése
$jsonUrl = 'http://soap.foglaljorvost-test.hu/teszt.json';
$jsonData = file_get_contents($jsonUrl);
$data = json_decode($jsonData, true);

// Ellenőrizzük, hogy az adatok sikeresen beolvadtak-e
if ($data === null) {
    die('Hiba történt a JSON adatok beolvasásakor.');
}

// Orvosok listázása
$doctors = $data['doctors'];
$clinics = $data['clinics'];
$doctorClinic = $data['doctor-clinic'];

// Keresési funkció
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Szűrt orvosok
$filteredDoctors = array_filter($doctors, function($doctor) use ($searchTerm) {
    return stripos($doctor['name'], $searchTerm) !== false;
});

// Orvosok és klinikák összekapcsolása
foreach ($filteredDoctors as &$doctor) {
    $clinicNames = [];
    foreach ($doctorClinic as $dc) {
        if ($dc['doctor_id'] == $doctor['id']) {
            foreach ($clinics as $clinic) {
                if ($clinic['id'] == $dc['clinic_id']) {
                    $clinicNames[] = $clinic['name'];
                    break; // Kilépünk a klinikák kereséséből
                }
            }
        }
    }
    $doctor['clinics'] = implode(', ', $clinicNames); // Klinika nevek listázása
}
?>