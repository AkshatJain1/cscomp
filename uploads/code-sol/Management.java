import java.io.File;
import java.util.Scanner;

public class Management {
    public static void main(String[] args) throws Exception {
        //initialize variables
        Scanner kb = new Scanner(new File("management.in"));
        Member s = new Member();
        Member r = new Member();
        Member k = new Member();
        s.easyT = kb.nextDouble(); kb.nextLine();
        s.mediumT = kb.nextDouble(); kb.nextLine();
        s.hardT = kb.nextDouble(); kb.nextLine();
        kb.nextLine();
        r.easyT = kb.nextDouble(); kb.nextLine();
        r.mediumT = kb.nextDouble(); kb.nextLine();
        r.hardT = kb.nextDouble(); kb.nextLine();
        kb.nextLine();
        k.easyT = kb.nextDouble(); kb.nextLine();
        k.mediumT = kb.nextDouble(); kb.nextLine();
        k.hardT = kb.nextDouble();

        //easy
        for (int i = 0; i < 4; i++) {
            if(s.easyT+s.time< r.easyT+r.time && s.easyT+s.time< k.time+k.easyT)
            {
                s.time+=s.easyT;
                s.ep++;
            }
            else if(r.easyT+r.time< s.easyT+s.time && r.easyT+r.time< k.time+k.easyT)
            {
                r.time+=r.easyT;
                r.ep++;
            }
            else
            {
                k.time+=k.easyT;
                k.ep++;
            }
        }
        //medium
        for (int i = 0; i < 4; i++) {
            if(s.mediumT+s.time< r.mediumT+r.time && s.mediumT+s.time< k.time+k.mediumT)
            {
                s.time+=s.mediumT;
                s.mp++;
            }
            else if(r.mediumT+r.time< s.mediumT+s.time && r.mediumT+r.time< k.time+k.mediumT)
            {
                r.time+=r.mediumT;
                r.mp++;
            }
            else
            {
                k.time+=k.mediumT;
                k.mp++;
            }
        }
        //hard
        for (int i = 0; i < 4; i++) {
            if(s.hardT+s.time< r.hardT+r.time && s.hardT+s.time< k.time+k.hardT)
            {
                s.time+=s.hardT;
                s.hp++;
            }
            else if(r.hardT+r.time< s.hardT+s.time && r.hardT+r.time< k.time+k.hardT)
            {
                r.time+=r.hardT;
                r.hp++;
            }
            else
            {
                k.time+=k.hardT;
                k.hp++;
            }
        }

        System.out.println("Shah: " + s);
        System.out.println("Rukh: " + r);
        System.out.println("Khan: " + k);
        System.out.println();

        double t = -1;
        if(s.time > r.time && s.time > k.time)
            t = s.time;
        else if(r.time > s.time && r.time > k.time)
            t = r.time;
        else
            t = k.time;
        System.out.println(t + " minutes");



    }
}
class Member{
    double easyT, mediumT, hardT;
    double time;
    int ep, mp, hp;
    public String toString(){
        String s = "";
        for (int i = 0; i < ep; i++) {
            s+= "Easy, ";
        }
        for (int i = 0; i < mp; i++) {
            s+= "Medium, ";
        }
        for (int i = 0; i < hp; i++) {
            s+= "Hard, ";
        }
        return s.substring(0,s.length()-2);
    }
}

