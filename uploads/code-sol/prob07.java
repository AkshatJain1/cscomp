import java.util.Scanner;
import java.util.ArrayList;
import java.io.File;
import java.io.FileNotFoundException;

public class prob07{
  public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob07.txt"));

    while(kb.hasNextLine()){
      int max_prime = Integer.parseInt(kb.nextLine());

      System.out.println(max(max_prime));
      System.out.println();

    }

  }

  public static ArrayList<Integer> max(int maxp) {
    ArrayList<Integer> p = new ArrayList<>();
    for(int x=2; x<maxp; x++){
        boolean isPrime = true;
        for(int y=2; y<x; y++){
          if(x%y==0){
            isPrime = false;
            break;
          }
        }
        if(isPrime)
          p.add(x);
    }
    return p;

  }
}
