DROP TABLE IF EXISTS TICKET;
CREATE TABLE TICKET (
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    TITLE TEXT NOT NULL,
    CLIENT_ID INTEGER REFERENCES PERSON(UP) NOT NULL,
    STATUS TEXT DEFAULT 'OPEN',
    DEPARTMENT TEXT  REFERENCES DEPARTMENT(NAME) ON DELETE CASCADE ON UPDATE CASCADE,
    CREATED_AT DATETIME NOT NULL
);
DROP TABLE IF EXISTS PERSON;
CREATE TABLE PERSON (
    UP INTEGER PRIMARY KEY
    CONSTRAINT test_column_positive CHECK (UP > 0),
    EMAIL TEXT NOT NULL,
    NAME TEXT NOT NULL,
    PASSWORD TEXT NOT NULL,
    ROLE TEXT NOT NULL DEFAULT 'Student'
    /*DEPARTMENT_NAME TEXT REFERENCES DEPARTMENT(NAME) ON DELETE CASCADE ON UPDATE CASCADE*/
);
DROP TABLE IF EXISTS DEPARTMENT;
CREATE TABLE DEPARTMENT (
    NAME TEXT PRIMARY KEY NOT NULL
);

DROP TABLE IF EXISTS TICKET_MESSAGE;
CREATE TABLE TICKET_MESSAGE (
    TEXT TEXT NOT NULL,
    TICKET_ID INTEGER REFERENCES TICKET(ID) ON DELETE CASCADE ON UPDATE CASCADE,
    PERSON_ID INTEGER REFERENCES PERSON(EMAIL) ON DELETE CASCADE ON UPDATE CASCADE,
    CREATED_AT DATETIME NOT NULL,
    DOCUMENT_ID INTEGER REFERENCES DOCUMENT(ID) ON DELETE CASCADE ON UPDATE CASCADE
);
DROP TABLE IF EXISTS DOCUMENT;
CREATE TABLE DOCUMENT (
  ID INTEGER PRIMARY KEY AUTOINCREMENT,
  NAME TEXT NOT NULL,
  CREATED_AT DATETIME NOT NULL
    /*We still need to figure out how to manage documents*/
);

DROP TABLE IF EXISTS TICKET_AGENTS;
CREATE TABLE TICKET_AGENTS(
  TICKET_ID INTEGER REFERENCES TICKET(ID) ON DELETE CASCADE ON UPDATE CASCADE,
  AGENT_ID INTEGER REFERENCES PERSON(EMAIL) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (TICKET_ID, AGENT_ID)
);
