import java.util.Scanner;
import java.util.ArrayList;
import java.io.File;
import java.io.FileNotFoundException;

public class prob05{
  public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob05.txt"));

    while(kb.hasNextLine()){
      String pass = kb.nextLine();
      int strength = 0;
      if(pass.length() >= 8){
        strength++;
      }
      boolean capital = false;       boolean lowercase = false; boolean special = false;
      for(int x = 0;x<pass.length(); x++){
        if(pass.charAt(x)>=65 && pass.charAt(x)<=90){
            capital = true;
        }
        else if(pass.charAt(x)>=97 && pass.charAt(x)<=122){
          lowercase = true;
        }
        else if(!special){
          special = true; strength++;

        }

      }
      if(capital && lowercase){
        strength++;
      }

      switch(strength){
        case 0:
              System.out.println("Weak");
              break;
        case 1:
              System.out.println("Acceptable");
              break;
        case 2:
              System.out.println("Good");
              break;
        case 3:
              System.out.println("Strong");
              break;
      }
    }

  }
}
