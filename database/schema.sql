DROP DATABASE IF EXISTS student_course_hub;
CREATE DATABASE student_course_hub;
USE student_course_hub;

DROP TABLE IF EXISTS InterestedStudents;
DROP TABLE IF EXISTS ProgrammeModules;
DROP TABLE IF EXISTS Programmes;
DROP TABLE IF EXISTS Modules;
DROP TABLE IF EXISTS Staff;
DROP TABLE IF EXISTS Levels;
DROP TABLE IF EXISTS AdminUsers;

CREATE TABLE Levels (
    LevelID INTEGER PRIMARY KEY,
    LevelName TEXT NOT NULL
);

CREATE TABLE Staff (
    StaffID INTEGER PRIMARY KEY,
    Name TEXT NOT NULL,
    Email VARCHAR(255) NULL UNIQUE,
    PasswordHash VARCHAR(255) NULL
);

CREATE TABLE Modules (
    ModuleID INTEGER PRIMARY KEY,
    ModuleName TEXT NOT NULL,
    ModuleLeaderID INTEGER,
    Description TEXT,
    Image TEXT,
    FOREIGN KEY (ModuleLeaderID) REFERENCES Staff(StaffID)
);

CREATE TABLE Programmes (
    ProgrammeID INTEGER PRIMARY KEY AUTO_INCREMENT,
    ProgrammeName TEXT NOT NULL,
    LevelID INTEGER,
    ProgrammeLeaderID INTEGER,
    Description TEXT,
    Image TEXT,
    FOREIGN KEY (LevelID) REFERENCES Levels(LevelID),
    FOREIGN KEY (ProgrammeLeaderID) REFERENCES Staff(StaffID)
);

CREATE TABLE ProgrammeModules (
    ProgrammeModuleID INTEGER PRIMARY KEY AUTO_INCREMENT,
    ProgrammeID INTEGER,
    ModuleID INTEGER,
    Year INTEGER,
    FOREIGN KEY (ProgrammeID) REFERENCES Programmes(ProgrammeID),
    FOREIGN KEY (ModuleID) REFERENCES Modules(ModuleID)
);

CREATE TABLE InterestedStudents (
    InterestID INT AUTO_INCREMENT PRIMARY KEY,
    ProgrammeID INT NOT NULL,
    StudentName VARCHAR(100) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    RegisteredAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ProgrammeID) REFERENCES Programmes(ProgrammeID) ON DELETE CASCADE
);

CREATE TABLE AdminUsers (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
