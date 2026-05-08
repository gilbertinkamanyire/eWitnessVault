# eWitnessVault: A Web-Based Digital Evidence Management System for the Uganda Justice Sector

**By**

## DEPARTMENT OF COMPUTER SCIENCE

## SCHOOL OF COMPUTING AND ENGINEERING

---

*A Concept Paper submitted to the School of Computing and Engineering*
*For the Study Leading to a Project Proposal in Partial Fulfilment of Requirements for the Award of the Degree of Bachelor of Science in Computer Science of Uganda Technology and Management University.*

---

**Supervisor**

Mr. [Supervisor Name]
Department of Computer Science
School of Computing and Engineering, Uganda Technology and Management University
[supervisor@utamu.ac.ug], +256789981418

**May 2026**

---

## GROUP MEMBERSHIP

| # | Names | Registration Number | Signature |
|---|-------|---------------------|-----------|
| 1 |       |                     |           |
| 2 |       |                     |           |
| 3 |       |                     |           |
| 4 |       |                     |           |

---

## 1. Introduction



The management and preservation of digital evidence in Uganda's justice sector has long been conducted through manual, paper-based systems that are prone to tampering, loss, and unauthorized access. As criminal cases increasingly involve digitally captured media such as photographs, audio recordings, and video footage, the need for a secure, traceable, and role-controlled digital repository has become critical. eWitnessVault is a proposed web-based digital evidence management system designed to streamline the collection, upload, assignment, review, and archiving of digital evidence across stakeholders including witnesses, investigators, and judicial officers — to ensure integrity, accountability, and transparency in the criminal justice process.

---

## 2. Background to the Problem

The Uganda justice sector, like many developing-world judicial systems, relies heavily on physical documentation and informal chains of custody for managing evidence. According to a report by the Uganda Law Reform Commission (2019), delays and inefficiencies in evidence handling remain a leading contributor to prolonged case backlogs and wrongful outcomes in criminal proceedings [1]. The manual transmission of evidence — from the point of collection by witnesses or law enforcement to investigators, and eventually to courts — creates multiple opportunities for evidence tampering, degradation, and loss.

Digital evidence, including photographs, video recordings, audio testimonies, and electronic documents, is becoming increasingly central to modern criminal investigation. However, the absence of a standardised digital infrastructure to receive, store, and authenticate such evidence means that most agencies resort to physical storage, email attachments, or unregulated cloud platforms that lack auditability and chain-of-custody guarantees [2]. This not only undermines the reliability of evidence presented in court but also exposes the justice process to legal challenges and procedural failures.

Global best practices, such as those described in the NIST Digital Evidence Guidelines (SP 800-101) [3], recommend the use of cryptographic hashing, metadata preservation, role-based access controls, and tamper-evident logging as cornerstones of any credible digital evidence management system. Countries such as Kenya and South Africa have already begun piloting integrated judicial technology systems; however, Uganda still lags in adopting such technologies at a broader systemic level [4]. Furthermore, witnesses and informants in remote areas often face logistical barriers when submitting evidence to investigators, including physical distance, transport costs, and fear of exposure. A secure web-based platform accessible via mobile or desktop would dramatically lower these barriers, enabling real-time geo-tagged evidence submission while protecting the safety of the submitter [5]. eWitnessVault addresses this gap by offering a structured, role-based platform where witnesses upload digitally captured evidence with GPS metadata and file hash verification, investigators review and manage case assignments, and judges access verified evidence for informed judicial decision-making — all within a single, secure, and auditable web environment.

---

## 3. Problem Statement

The problem this project will address is the lack of a secure, traceable, and standardised digital system for managing evidence in Uganda's criminal justice sector. Currently, digital evidence collected by witnesses and law enforcement officers is transmitted through informal and insecure channels — including physical delivery, email, and unregulated cloud platforms — that cannot guarantee authenticity, chain of custody, or controlled access. This results in evidence tampering, misplacement, unauthorized disclosure, and delayed justice. Without a centralised platform that enforces file integrity hashing, captures GPS metadata, implements role-based permissions, and maintains a full audit trail, Uganda's justice system remains vulnerable to evidence fraud, procedural inefficiency, and erosion of public trust in judicial outcomes. The eWitnessVault system is proposed to fill this gap by providing an authenticated, metadata-rich, and auditable digital evidence vault accessible to all stakeholders in the justice chain.

---

## 4. Objectives

### 4.1. Main Objective

To design and develop eWitnessVault — a secure, web-based digital evidence management system that enables role-based submission, assignment, review, and archival of digital evidence with full chain-of-custody tracking for Uganda's criminal justice sector.

### 4.2. Specific Objectives

i. To investigate existing evidence management practices in Uganda's justice sector and gather system requirements from relevant stakeholders including witnesses, investigators, and judicial officers.

ii. To design a secure, role-based system architecture for eWitnessVault, incorporating database schema, user access control models, GPS metadata capture, and SHA-256 cryptographic file hashing mechanisms.

iii. To implement a functional prototype of the eWitnessVault system using the Laravel PHP framework and a relational database management system, supporting multi-role user authentication, secure file upload, evidence status tracking, and audit logging.

iv. To test and validate the eWitnessVault prototype through unit testing, integration testing, and user acceptance testing to confirm system correctness, data integrity enforcement, and usability across all defined user roles.

---

## 5. Methodology

The development of eWitnessVault will follow an adapted **Agile Software Development** methodology, with iterative sprints aligned to each specific objective. Agile is selected for its flexibility in responding to evolving stakeholder feedback and its proven suitability for web-based application development in resource-constrained environments.

**Objective 1 - Requirements Gathering:** Structured interviews and document analysis will engage representatives from the Uganda Police Force, the Directorate of Public Prosecutions (DPP), and the Judiciary. Requirements covering evidence types, submission workflows, stakeholder roles, and security expectations will be extracted. Secondary data from literature, legal frameworks (e.g., Uganda's Electronic Signatures Act, 2011; Computer Misuse Act, 2011), and international digital forensics standards will supplement findings, culminating in a formal Software Requirements Specification (SRS).

**Objective 2 - System Design:** A layered system architecture will be designed consisting of a presentation layer (Blade/Vite front-end), application logic layer (Laravel MVC), and data persistence layer (MySQL). Design deliverables will include Entity-Relationship Diagrams (ERD), Data Flow Diagrams (DFD), use case diagrams, and wireframes for each user role — Witness, Investigator, Judge, and System Administrator. GPS metadata schemas, SHA-256 hashing workflows, and role-permission matrices will be formally documented.

*(Space for System Design Diagrams: ERD, DFD, and Use Case Diagrams)*

\pagebreak

**Objective 3 - System Implementation:** The prototype will be built using Laravel 11 for back-end logic, Vite and Blade templates for the front-end, and MySQL as the relational database. Core features include: multi-role authentication with email verification; secure evidence upload with MIME-type validation and SHA-256 hashing; GPS coordinate capture and storage; evidence status lifecycle management (Pending to Under Review to Approved/Rejected); investigator assignment workflows; admin dashboards with role and user management; and full audit logging. All modules will follow the MVC design pattern with middleware-based authorization guards.

*(Space for System Prototype Screenshots: Dashboard, Evidence Upload, and Audit Logs)*

\pagebreak


**Objective 4 - Testing and Validation:** Testing will occur in three phases: (a) Unit Testing using PHPUnit to verify model methods, validation rules, and controller logic; (b) Integration Testing to validate end-to-end workflows across roles from evidence submission to judicial review; and (c) User Acceptance Testing (UAT) with selected justice officials and student surrogate users to evaluate real-world usability. Results will be documented against predefined functional and non-functional acceptance criteria, and identified defects resolved through iterative fix-and-retest cycles prior to final submission.

---

## 6. Outcomes

At the end of this project, the following targeted outcomes are expected:

i. **A Functional Web-Based Prototype** — A fully operational eWitnessVault system deployable on a standard PHP/MySQL web server, demonstrating a complete digital evidence lifecycle from submission to judicial review.

ii. **Role-Based Access Control Module** — Fully implemented and tested roles for Witness, Investigator, Judge, and Admin, each with distinct dashboards, permissions, and workflow capabilities.

iii. **Secure Evidence Repository** — A structured file storage system with SHA-256 hash verification, GPS metadata capture, MIME-type validation, and tamper detection to guarantee evidence authenticity.

iv. **Audit Trail and Chain-of-Custody System** — A complete chronological log of all evidence submissions, status transitions, role assignments, and judicial reviews, ensuring full legal accountability.

v. **System Documentation and User Manuals** — Comprehensive technical documentation including architecture diagrams, database schema, user role guides, and test reports deliverable to the institution and prospective adopters.

vi. **Research Findings Report** — A documented analysis of the current state of evidence management in Uganda, providing empirical data and recommendations for digital justice infrastructure reform in the country.

---

## 7. References

[1] Uganda Law Reform Commission, *Report on the Administration of Criminal Justice in Uganda*, Kampala: ULRC Publications, 2019.

[2] R. Bhatt and A. Chaudhary, "Challenges in Digital Evidence Management in Developing Judicial Systems," *International Journal of Computer Applications*, vol. 182, no. 5, pp. 18-24, 2019. doi: 10.5120/ijca2019918621.

[3] R. Ayers, S. Brothers, and W. Jansen, *Guidelines on Mobile Device Forensics*, NIST Special Publication 800-101 Rev. 1, National Institute of Standards and Technology, Gaithersburg, MD, USA, 2014. [Online]. Available: https://doi.org/10.6028/NIST.SP.800-101r1.

[4] A. Kaggwa and J. Muwonge, "Digital Transformation of Judicial Processes in East Africa: Opportunities and Barriers," *African Journal of Information Systems*, vol. 14, no. 3, pp. 45-63, 2022.

[5] M. Losavio, K. Chow, A. Koltay, and J. James, "The Internet of Things and the Smart City: Legal Challenges with Digital Forensics, Privacy, and Security," *Security and Privacy*, vol. 1, no. 3, e23, 2018. doi: 10.1002/spy2.23.

[6] T. Vidas, C. Zhang, and N. Christin, "Toward a General Collection Methodology for Android Devices," in *Proc. DFRWS Annual Digital Forensics Research Conference*, 2011, pp. S14-S24.

[7] O. Osho and S. O. Ohida, "Comparative Evaluation of Mobile Forensic Tools," *International Journal of Information Technology and Computer Science*, vol. 8, no. 1, pp. 74-83, Jan. 2016. doi: 10.5815/ijitcs.2016.01.09.

---

*© 2026 Department of Computer Science, School of Computing and Engineering, Uganda Technology and Management University. All rights reserved.*
