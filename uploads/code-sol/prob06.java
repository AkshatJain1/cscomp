import java.util.Scanner;
import java.util.ArrayList;
import java.io.File;
import java.io.FileNotFoundException;

public class prob06{
  public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob06.txt"));

    while(kb.hasNextLine()){
      double overhang = Double.parseDouble(kb.nextLine());

      System.out.println(cards(overhang));

    }

  }

  public static int cards(double overhang) {
    int cards = 0;
    double sum = 0;
    while(sum < overhang) {
      cards++;
      sum += 1.0/(cards+1);
    }

    return cards;

  }
}
