-- Table Creation

CREATE TABLE CUGDetails (
    cug_id INT AUTO_INCREMENT PRIMARY KEY,
    cug_number BIGINT NOT NULL CHECK (CHAR_LENGTH(cug_number) <= 11),
    emp_number BIGINT UNIQUE NOT NULL CHECK (CHAR_LENGTH(emp_number) = 12),
    empname VARCHAR(100) NOT NULL,
    designation VARCHAR(100) NOT NULL,
    unit VARCHAR(50) NOT NULL,
    department VARCHAR(100) NOT NULL,
    bill_unit_no VARCHAR(50) NOT NULL,
    allocation DECIMAL(10, 2) NOT NULL CHECK (allocation >= 0),
    operator VARCHAR(50) NOT NULL,
    plan ENUM('A', 'B', 'C') NOT NULL,
    status ENUM('Active', 'Inactive') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert Data

INSERT INTO CUGDetails (cug_number, emp_number, empname, designation, unit, department, bill_unit_no, allocation, operator, plan, status)
VALUES
(10147857981, 365166527088, 'DALLAP KUMDR SDMDL', 'AA', 'CON', 'S & T', '3106854', 873106, 'JIO', 'C', 'Active'),
(10147857211, 365166583134, 'DRUN KUMDR DDS', 'AA', 'CON', 'ENGG', '06771', 873106, 'JIO', 'C', 'Active'),
(10147857982, 365166526948, 'SESDDEV MBPDLAK', 'Sr. SO Acct', 'CON', 'S & T', '06025', 873106, 'JIO', 'C', 'Active'),
(10147857985, 365166455745, 'LDLAT MBPDN SDPU', 'Sr. SO Acct', 'CON', 'ELECT', '06167', 873106, 'JIO', 'C', 'Active'),
(10147857991, 365166140619, 'PRDSDNTD KR.MEPER', 'Sr. AUO', 'CON', 'ENGG', '06287', 873106, 'JIO', 'C', 'Active'),
(10147857993, 365165989202, 'DPARENDRD KUMDR PURA', 'Ch.COML.INSP.', 'CON', 'ENGG', '06025', 873106, 'JIO', 'C', 'Active'),
(10147857202, 365167900933, 'E.S.K.PDTRB', 'SSE(TRS)', 'CON', 'ENGG', '07295', 873106, 'JIO', 'C', 'Active'),
(10147857201, 365167927047, 'CPATTD RDNJDN SWDAN', 'SSE(TRS)', 'CON', 'S & T', '02854', 873106, 'JIO', 'C', 'Active'),
(10147857195, 365168340827, 'SDNTBSP KUMDR GBUDD', 'GEN.ASST(ELEC)', 'CON', 'ACCTS', '01001', 873106, 'JIO', 'C', 'Active'),
(10147857987, 365166367778, 'PRDTAMD RBUT', 'GEN.ASST(ENG)', 'CON', 'ELECT', '06025', 873106, 'JIO', 'C', 'Active'),
(10147857986, 365166436842, 'SUSDNT KUMDR NDYDK', 'Dy.CVO(STORES)', 'CON', 'ACCTS', '05003', 873106, 'JIO', 'C', 'Active'),
(10147857994, 365165937690, 'SDNJAB KUMDR DDLDBEPERD', 'OS', 'CON', 'ENGG', '06772', 873106, 'JIO', 'C', 'Active'),
(10147857992, 365166036453, 'RENUBDLD SDPBB', 'OS', 'CON', 'ENGG', '01625', 873106, 'JIO', 'C', 'Active'),
(10147857984, 365166470706, 'SDMAR KUMDR LENKD', 'Ch.OS', 'CON', 'ELECT', '3109167', 873106, 'JIO', 'C', 'Active'),
(10147857194, 365168341494, 'BDRSD RDNA MDNAK', 'NURSING SUPDT', 'CON', 'ENGG', '07295', 873106, 'JIO', 'C', 'Active'),
(10147857205, 365166898010, 'PUTSDLD PEMDNT KUMDR', 'AOM', 'CON', 'ELECT', '06025', 873106, 'JIO', 'C', 'Active'),
(10147857224, 365165787556, 'PRDNDB KASPBRE BDLADRSANGP', 'SAFETY COUNSELLOR', 'CON', 'S & T', '06025', 873106, 'JIO', 'C', 'Active'),
(10147857193, 365168635753, 'PDLDGDNNE SPESDGARA RDB', 'CONSTABLE', 'CON', 'ACCTS', '06001', 873106, 'JIO', 'C', 'Active'),
(10147857191, 365168737048, 'GBVANDD MEPER', 'CONSTABLE', 'CON', 'ENGG', '06287', 873106, 'JIO', 'C', 'Active'),
(10147857199, 365168236040, 'FDKARD MBPDN BEPERD', 'CONSTABLE', 'CON', 'ELECT', '06167', 873106, 'JIO', 'C', 'Active'),
(10147857198, 365168337269, 'MDNBRDNJDN PDRAMDNAK', 'CONSTABLE', 'CON', 'S & T', '06853', 873106, 'JIO', 'C', 'Active'),
(10147857208, 365166589505, 'DSPBK KUMDR PDTTDNDAK', 'JE DRAWING SnT', 'CON', 'ENGG', '06025', 873106, 'JIO', 'C', 'Active'),
(10147857983, 365166485932, 'RDJKUMDR MDNDD', 'PUR.SUPDT.', 'CON', 'ACCTS', '06001', 873106, 'JIO', 'C', 'Active'),
(10147857189, 365168840068, 'M.MDDPDVD RDB', 'SSE (TRK MACHINE)', 'CON', 'S & T', '06025', 873106, 'JIO', 'C', 'Active'),
(9677142604, 342184036333, 'PRDTDP KUMDR JEND', 'AC', 'CON', 'ACCTS', '06001', 873106, 'JIO', 'C', 'Active'),
(9677141709, 339555256153, 'SPDSPA KDNT MASPRD', 'FAnCAO', 'CON', 'ENGG', '06287', 873106, 'JIO', 'C', 'Active'),
(9677137458, 362276237069, 'SUMDND MBPDNTY', 'FAnCAO/TRAFFIC', 'CON', 'ENGG', '06025', 873106, 'JIO', 'C', 'Active'),
(9677141905, 363155739851, 'Y.DNDND', 'FAnCAO/WnS', 'CON', 'S & T', '06853', 873106, 'JIO', 'C', 'Active'),
(9677145886, 365154987804, 'NARMDL CPDNDRD SDRDNGA', 'AFA', 'CON', 'ENGG', '06287', 873106, 'JIO', 'C', 'Active');
