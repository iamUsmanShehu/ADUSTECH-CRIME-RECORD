from pyfingerprint.pyfingerprint import PyFingerprint
import mysql.connector

def verify_fingerprint():
    try:
        f = PyFingerprint('/dev/ttyUSB0', 57600, 0xFFFFFFFF, 0x00000000)
        if (f.verifyPassword() == False):
            raise ValueError('The given fingerprint sensor password is wrong!')
    except Exception as e:
        print('The fingerprint sensor could not be initialized!')
        print('Exception message: ' + str(e))
        exit(1)

    print('Waiting for finger...')
    while (f.readImage() == False):
        pass

    f.convertImage(0x01)
    characteristics = f.downloadCharacteristics(0x01)
    return characteristics

def match_fingerprint(characteristics):
    conn = mysql.connector.connect(user='root', password='', host='localhost', database='student_attendance_system')
    cursor = conn.cursor()

    sql = "SELECT student_id, fingerprint_template FROM students"
    cursor.execute(sql)
    students = cursor.fetchall()
    
    for student in students:
        stored_characteristics = student[1]
        if stored_characteristics == characteristics:
            return student[0]

    conn.close()
    return None

if __name__ == '__main__':
    characteristics = verify_fingerprint()
    student_id = match_fingerprint(characteristics)
    if student_id:
        print(f'Student ID {student_id} verified successfully!')
    else:
        print('Fingerprint not recognized.')
