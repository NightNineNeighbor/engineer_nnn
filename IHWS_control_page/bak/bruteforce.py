def skewer(t):
    return ord(t)-53;
import sys,base64,os,re;password=base64.b64decode("pb24")
r = 0
while(1){
r++
arg = base64.b64encode("".join(chr(r)));
if(os.popen("perl brute.pl "+arg).read()=="No")break;
}
