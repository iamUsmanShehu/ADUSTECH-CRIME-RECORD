from pyfingerprint.pyfingerprint import PyFingerprint
import mysql.connector
import sys

def capture_fingerprint():
    try:
        f = PyFingerprint('/dev/ttyUSB0', 57600, 0xFFFFFFFF, 0x00000000)
        if (f.verifyPassword() == False):
            raise ValueError('The given fingerprint sensor password is wrong!')
    except Exception as e:
        print('The fingerprint sensor could not be initialized!')
        print('Exception message: ' + str(e))
        sys.exit(1)

    print('Waiting for finger...')
    while (f.readImage() == False):
        pass

    f.convertImage(0x01)
    result = f.searchTemplate()
    positionNumber = result[0]

    if (positionNumber >= 0):
        print('Fingerprint already exists at position #' + str(positionNumber))
        sys.exit(0)

    f.createTemplate()
    characteristics = f.downloadCharacteristics(0x01)
    return characteristics

def store_fingerprint(suspect_id, name, characteristics):
    conn = mysql.connector.connect(user='root', password='', host='localhost', database='murja_fingerprint_test')
    cursor = conn.cursor()

    sql = "INSERT INTO suspects (suspect_id, name, fingerprint_template) VALUES (%s, %s, %s)"
    cursor.execute(sql, (suspect_id, name, characteristics))
    conn.commit()
    conn.close()

if __name__ == '__main__':
    if len(sys.argv) != 3:
        print("Usage: capture_fingerprint.py <suspect_id> <name>")
        sys.exit(1)

    suspect_id = sys.argv[1]
    name = sys.argv[2]
    characteristics = capture_fingerprint()
    store_fingerprint(suspect_id, name, characteristics)
    print('Fingerprint captured and stored successfully!')
