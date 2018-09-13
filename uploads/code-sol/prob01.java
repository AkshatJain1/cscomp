import java.util.Scanner;
import java.io.File;
import java.io.FileNotFoundException;

public class prob01{
   public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob01.txt"));
    String name = kb.nextLine();
    System.out.println("Hi "+name+", I am excited to be a part of the Tompkins Computer Science Team!");
  }
}
