import java.util.Scanner;
import java.io.File;
import java.io.FileNotFoundException;

public class prob02{
   public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob02.txt"));
    while(kb.hasNextLine()){
    int num = Integer.parseInt(kb.nextLine());
      for(int x = 0; x <= num; x++){
        System.out.println("2^" + x + " = " + (int)Math.pow(2,x));
      }
      System.out.println();
    }
  }
}
