import java.util.Scanner;
import java.util.ArrayList;
import java.io.File;
import java.io.FileNotFoundException;

public class prob04{
  public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob04.txt"));

    while(kb.hasNextLine()){
      int x = kb.nextInt();
      int y = kb.nextInt();

      long num = factorial(x) / (factorial(y) * factorial(x-y));
      System.out.println(num);
      kb.nextLine();
    }
  }
  public static long factorial(int num) {
    if(num == 1){
      return 1;
    }
    else{
      return num * factorial(num-1);
    }
  }
}
