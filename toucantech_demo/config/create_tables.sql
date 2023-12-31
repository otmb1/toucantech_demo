CREATE TABLE IF NOT EXISTS schools (
    school_id INT AUTO_INCREMENT PRIMARY KEY,
    school_name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    member_name VARCHAR(255) NOT NULL,
    member_email VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS member_school (
    member_school_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    school_id INT,
    FOREIGN KEY (member_id) REFERENCES members(member_id),
    FOREIGN KEY (school_id) REFERENCES schools(school_id)
);
