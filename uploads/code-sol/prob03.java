import java.util.Scanner;
import java.util.ArrayList;
import java.io.File;
import java.io.FileNotFoundException;

public class prob03{
   public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob03.txt"));
    ArrayList<String> lines = new ArrayList<String>();
    int max_size = 0;
    while(kb.hasNextLine()){
      String line = kb.nextLine();
      if(line.length() > max_size){
        max_size = line.length();
      }

      lines.add(line);

    }

    for(int x =0; x < max_size; x++){
      for(int y =0; y < lines.size(); y++){
        if(lines.get(y).length() > x) {
          char letter = lines.get(y).charAt(x);
          System.out.print(letter + "  ");
        }
        else {
          System.out.print("   ");
        }
      }
      System.out.println();
    }
  }
}
