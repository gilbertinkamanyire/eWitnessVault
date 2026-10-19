# eWitnessVault System Diagrams (Mermaid Specifications)

This document contains ready-to-use Mermaid codes for generating all the diagrams required for the **eWitnessVault** project report, technical documentation, or thesis.

You can render these directly in GitHub Markdown, Notion, Obsidian, Visual Studio Code (Markdown Preview Mermaid Support), or paste them into the online [Mermaid Live Editor](https://mermaid.live).

---

## 1. System Architecture Diagram (Multi-Tier Architecture)

```mermaid
flowchart TB
    subgraph ClientLayer ["Client & Interface Layer"]
        direction LR
        WebClient["Desktop / Web Portal\n(Laravel Blade + Vite JS)"]
        MobileClient["Mobile Capture App\n(Capacitor / Android Client)"]
    end

    subgraph GatewayLayer ["Reverse Proxy & Web Server"]
        Nginx["Web / Proxy Server\n(Nginx / Apache HTTPS)"]
    end

    subgraph AppLayer ["Application Logic Layer (Laravel Backend)"]
        direction TB
        AuthModule["Auth & Access Control\n(RBAC / Sanctum)"]
        EvidenceCtrl["Evidence & Docket Controller"]
        HashEngine["SHA-256 Hashing Engine"]
        CustodyLogger["Chain-of-Custody Audit Engine"]
        GemmaOrchestrator["Gemma AI Orchestration Service"]
    end

    subgraph AiLayer ["AI Intelligence Layer (Google Gemma)"]
        direction TB
        GemmaAPI["Gemma 3 / Gemma 2 Service\n(Sovereign / On-Premise GPU or HF API)"]
        ForensicAnalytic["Telemetry & Admissibility Analyzer"]
        BriefSynthesizer["Multi-Exhibit Docket Summarizer"]
    end

    subgraph DataLayer ["Data & Storage Layer"]
        direction LR
        RelationalDB[("Relational Database\n(MySQL / PostgreSQL)\nUsers, Cases, Evidence, Logs")]
        VaultStorage[("Encrypted Vault Storage\n(/storage/app/vault)\nRaw Exhibits & Thumbnails")]
    end

    WebClient -->|HTTPS / REST| Nginx
    MobileClient -->|HTTPS / REST API| Nginx
    Nginx --> AuthModule
    AuthModule --> EvidenceCtrl

    EvidenceCtrl --> HashEngine
    EvidenceCtrl --> CustodyLogger
    EvidenceCtrl --> GemmaOrchestrator

    EvidenceCtrl --> RelationalDB
    HashEngine --> VaultStorage
    CustodyLogger --> RelationalDB

    GemmaOrchestrator --> GemmaAPI
    GemmaAPI --> ForensicAnalytic
    GemmaAPI --> BriefSynthesizer
```

---

## 2. Entity-Relationship Diagram (ERD / Database Schema)

```mermaid
erDiagram
    USERS ||--o{ EVIDENCE : "submits / uploads"
    USERS ||--o{ CASES : "assigned_judge / creates"
    CASES ||--o{ EVIDENCE : "contains"
    EVIDENCE ||--o{ CHAIN_OF_CUSTODY_LOGS : "tracks"
    EVIDENCE ||--o{ AI_ANALYSIS_REPORTS : "analyzed_by"
    CASES ||--o{ AI_ANALYSIS_REPORTS : "docket_briefed_by"
    USERS ||--o{ USER_ROLES : "belongs_to"
    ROLES ||--o{ USER_ROLES : "assigned_to"

    USERS {
        bigint id PK
        string name
        string email
        string password
        string phone_number
        boolean is_verified
        timestamp created_at
    }

    ROLES {
        bigint id PK
        string name "judge, lawyer, investigator, admin"
        string description
    }

    USER_ROLES {
        bigint id PK
        bigint user_id FK
        bigint role_id FK
    }

    CASES {
        bigint id PK
        string case_number UK
        string title
        text description
        string court_jurisdiction
        string status "pending, in_progress, closed"
        bigint assigned_judge_id FK
        timestamp created_at
    }

    EVIDENCE {
        bigint id PK
        bigint user_id FK
        bigint case_id FK
        string title
        text description
        string file_path
        string file_type "image, video, audio, document"
        string sha256_hash "Tamper-proof signature"
        decimal latitude
        decimal longitude
        decimal altitude
        timestamp captured_at
        string device_make_model
        string device_id
        string status "sealed, verified, challenged, archived"
        timestamp created_at
    }

    CHAIN_OF_CUSTODY_LOGS {
        bigint id PK
        bigint evidence_id FK
        bigint performed_by_user_id FK
        string action "ingestion, accessed, transferred, verified"
        string verification_status "valid, tampered"
        string recorded_hash
        string client_ip
        timestamp logged_at
    }

    AI_ANALYSIS_REPORTS {
        bigint id PK
        bigint evidence_id FK
        bigint case_id FK
        string model_used "gemma-3-legal / gemma-2-9b"
        text forensic_summary
        text inconsistencies_detected
        string admissibility_risk "LOW, MEDIUM, HIGH"
        timestamp generated_at
    }
```

---

## 3. UML Use Case Diagram

```mermaid
flowchart LR
    subgraph Actors
        Investigator(("Field Officer /<br/>Investigator"))
        Lawyer(("Lawyer /<br/>Prosecutor"))
        Judge(("Judge /<br/>Court Clerk"))
        Admin(("System Admin"))
        GemmaAI(("Google Gemma AI<br/>Engine"))
    end

    subgraph eWitnessVault ["eWitnessVault System"]
        UC1(["Capture & Upload Evidence"])
        UC2(["Extract Telemetry & Generate SHA-256 Seal"])
        UC3(["Manage Legal Cases & Dockets"])
        UC4(["Inspect Chain-of-Custody Trail"])
        UC5(["Verify File Integrity (Hash Check)"])
        UC6(["Run Exhibit Forensic Analysis"])
        UC7(["Generate Case Docket AI Brief"])
        UC8(["Export Admissibility Certificate (PDF)"])
        UC9(["Manage Users, Roles & AI API Config"])
    end

    Investigator --> UC1
    Investigator --> UC2
    Investigator --> UC4

    Lawyer --> UC3
    Lawyer --> UC4
    Lawyer --> UC5
    Lawyer --> UC6
    Lawyer --> UC7
    Lawyer --> UC8

    Judge --> UC3
    Judge --> UC4
    Judge --> UC5
    Judge --> UC7
    Judge --> UC8

    Admin --> UC9
    Admin --> UC4

    UC6 -.-> GemmaAI
    UC7 -.-> GemmaAI
    UC1 ..> UC2 : "<<include>>"
    UC5 ..> UC8 : "<<extend>>"
```

---

## 4. Sequence Diagram: Evidence Ingestion & Cryptographic Sealing

```mermaid
sequenceDiagram
    autonumber
    actor Officer as Field Investigator
    participant App as Mobile/Web Client
    participant Controller as EvidenceController
    participant Crypto as HashingEngine
    participant Vault as Vault Storage (Disk)
    participant DB as Relational Database

    Officer->>App: Capture/Select Media file & provide notes
    App->>App: Extract device telemetry (GPS, Device ID, Timestamp)
    App->>Controller: POST /api/evidence (File + Telemetry payload)
    
    activate Controller
    Controller->>Crypto: ComputeSHA256(UploadedFile)
    activate Crypto
    Crypto-->>Controller: Return 64-char Hex Digest (Hash)
    deactivate Crypto

    Controller->>Vault: Store file in secure immutable directory
    Vault-->>Controller: File path confirmed

    Controller->>DB: INSERT into `evidence` (Hash, Telemetry, FilePath, Status="sealed")
    DB-->>Controller: Evidence Record ID

    Controller->>DB: INSERT into `chain_of_custody_logs` (Action="ingestion", Hash, UserID, Timestamp)
    DB-->>Controller: Log entry committed

    Controller-->>App: 201 Created (Evidence Sealed & Exhibit ID)
    deactivate Controller
    
    App-->>Officer: Display Digital Proof of Ingestion & Cryptographic Seal
```

---

## 5. Sequence Diagram: Gemma AI Forensic Analysis Workflow

```mermaid
sequenceDiagram
    autonumber
    actor Counsel as Lawyer / Judge
    participant UI as Web Dashboard
    participant Backend as EvidenceForensicController
    participant GemmaService as GemmaAIService
    participant GemmaModel as Google Gemma (Local / API)
    participant DB as Relational Database

    Counsel->>UI: Click "Run AI Forensic Audit" on Exhibit
    UI->>Backend: POST /evidence/{id}/analyze-ai
    activate Backend

    Backend->>DB: Retrieve Evidence record, Telemetry & Custody timeline
    DB-->>Backend: Evidence details (Capture time, Upload time, GPS, Notes)

    Backend->>GemmaService: preparePrompt(Telemetry, TimestampDelta, Description)
    activate GemmaService
    Note over GemmaService: Constructs strict judicial forensic prompt<br/>scrubbing personal identifiable information
    GemmaService->>GemmaModel: Send prompt (Structured Legal Reasoning)
    activate GemmaModel
    
    GemmaModel-->>GemmaService: JSON Analysis (Admissibility, Gaps, Timeline validity)
    deactivate GemmaModel
    GemmaService-->>Backend: Parsed AI Forensic Insights
    deactivate GemmaService

    Backend->>DB: INSERT into `ai_analysis_reports` (EvidenceID, Summary, RiskScore)
    DB-->>Backend: Report Saved

    Backend-->>UI: 200 OK (Render Forensic Findings & Admissibility Assessment)
    deactivate Backend
    UI-->>Counsel: Display AI Legal Insights & Cross-Examination Pointers
```

---

## 6. Activity Diagram: Evidence Verification & Admissibility Check

```mermaid
flowchart TD
    Start([Start: Verification Request in Court / Audit]) --> InputExhibit[Select Exhibit & Docket ID]
    InputExhibit --> RetrieveRecords[Retrieve Stored Record & Recorded SHA-256 Hash from DB]
    RetrieveRecords --> FetchRawFile[Read Raw File Binary from Vault Storage]
    FetchRawFile --> RecomputeHash[Re-compute SHA-256 Hash on Raw Binary]
    
    RecomputeHash --> CompareCheck{Does Computed Hash == Recorded Hash?}

    CompareCheck -- YES --> CheckCustody[Examine Custody Transfer Logs]
    CheckCustody --> LogsValid{Are all custody handovers unbroken?}

    LogsValid -- YES --> SetVerified[Set Status: INTEGRITY VERIFIED & ADMISSIBLE]
    SetVerified --> GenCert[Generate Court Admissibility Certificate with QR Code]
    GenCert --> EndSuccess([End: Exhibit Admitted into Record])

    LogsValid -- NO --> FlagGap[Set Warning: CHAIN OF CUSTODY DEFICIENCY]
    FlagGap --> LogAudit[Log Audit Alert in System]

    CompareCheck -- NO --> FlagTampered[FLAG TAMPER ALERT: File Content Altered!]
    FlagTampered --> SetInadmissible[Set Status: COMPROMISED / INADMISSIBLE]
    SetInadmissible --> LogAudit
    LogAudit --> EndFail([End: Evidence Rejected])
```

---

## 7. UML Component Diagram

```mermaid
flowchart TB
    subgraph UIComponent ["Presentation Components"]
        BladeUI["Blade Views & Layouts"]
        VueVite["Dynamic Components (Alpine/Vite)"]
        CapacitorWrapper["Capacitor Native Bridges (Camera/Geolocation)"]
    end

    subgraph CoreBackend ["Laravel Application Components"]
        Router["Routing & Middleware (Sanctum/Auth)"]
        EvidenceMgr["Evidence Management Component"]
        SecurityComp["Cryptographic Integrity Component (SHA-256)"]
        CaseMgr["Case & Docket Management Component"]
        CustodyComp["Chain of Custody Tracking Component"]
        ReportGenerator["PDF Export & Certificate Component"]
    end

    subgraph AIService ["AI Subsystem"]
        PromptBuilder["Forensic Prompt Engineering Component"]
        GemmaConnector["Gemma Client Adapter (HuggingFace / Ollama / Local)"]
    end

    subgraph Persistence ["Persistence Layer"]
        DBAccess["Database Driver (Eloquent ORM)"]
        StorageDriver["Storage Driver (Flysystem Local / S3 Encrypted)"]
    end

    UIComponent --> Router
    Router --> EvidenceMgr
    Router --> CaseMgr

    EvidenceMgr --> SecurityComp
    EvidenceMgr --> CustodyComp
    EvidenceMgr --> PromptBuilder

    PromptBuilder --> GemmaConnector
    EvidenceMgr --> ReportGenerator

    EvidenceMgr --> DBAccess
    CaseMgr --> DBAccess
    CustodyComp --> DBAccess
    SecurityComp --> StorageDriver
```

---

## 8. Deployment Diagram (Courthouse On-Premises & Hybrid Deployment)

```mermaid
flowchart TB
    subgraph ClientDevices ["Client Hardware Devices"]
        CourtPC["Judicial Desktop Terminal\n(Chrome / Edge Browser)"]
        PatrolDevice["Field Investigator Device\n(Android Tablet / Smartphone)"]
    end

    subgraph DMZ ["Demilitarized Zone / Courthouse Gateway"]
        Firewall["Hardware Firewall & SSL Terminator"]
    end

    subgraph AppServerNode ["Application Server Node (Ubuntu Linux)"]
        WebServer["Nginx Web Server"]
        PHPRuntime["PHP 8.2+ / PHP-FPM"]
        LaravelApp["eWitnessVault Core Application Code"]
        StorageVolume[("Secured Evidence Storage\n(Encrypted LVM / NVMe)")]
    end

    subgraph DatabaseNode ["Database Server Node"]
        MySQLServer[("MySQL 8.0+ Enterprise Database\n(Encrypted at Rest)")]
    end

    subgraph AIServerNode ["Sovereign AI Compute Node (Secure Courthouse Enclave)"]
        GPU["Dedicated NVIDIA GPU (e.g. RTX / A100 / L4)"]
        InferenceEngine["vLLM / Ollama Runtime"]
        GemmaWeights["Google Gemma 3 / 2 Model Weights"]
    end

    CourtPC -->|HTTPS 443| Firewall
    PatrolDevice -->|HTTPS 443 / VPN| Firewall
    Firewall --> WebServer
    WebServer --> PHPRuntime
    PHPRuntime --> LaravelApp

    LaravelApp --> StorageVolume
    LaravelApp -->|TCP 3306| MySQLServer
    LaravelApp -->|gRPC / REST 11434| InferenceEngine

    InferenceEngine --> GPU
    InferenceEngine --> GemmaWeights
```
