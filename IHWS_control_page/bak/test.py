def skewer(t):
    return t-53;

password = 0

while password <=256:
    password = password+1
    r=(skewer(password)+7%256+5+0**2)%256
        if r == 72:
        print password
