# Changelog

All notable changes to this project will be documented in this file.

---

## [Unreleased] - 2026-02-21

### Added
- **PDF export feature**: new button "Export PDF" in the main view that downloads all records stored in the database as a formatted PDF table (`registros.pdf`).
  - Installed `barryvdh/laravel-dompdf` (`^3.1`) as a dependency.
  - New route `GET /csv/download-pdf` (`csv.download-pdf`).
  - New method `downloadPdf()` in `CsvController` — loads all `CsvRow` records and generates an A4 landscape PDF.
  - New Blade view `resources/views/csv/pdf.blade.php` with styled table (colored header, alternating row background, generation timestamp, and record count).


---

## [1.2.0] - 2024 (PR #2 — david-meneses/feature/download-latest-xml)

### Added
- Download latest record as XML (`GET /csv/downloadLatestRecord/xml`).

---

## [1.1.0] - 2024 (PR #1 — david-meneses/feature-Dario)

### Added
- Download latest record as JSON/TXT (`GET /csv/downloadLatestRecord`).
- Unit test for the download latest record feature.

---

## [1.0.0] - 2024 (Initial commits)

### Added
- CSV file upload form.
- CSV rows stored in MySQL as JSON in the `csv_rows` table.
- Table view of all uploaded records on the main page.
- Test data file `test_data/test.csv`.
