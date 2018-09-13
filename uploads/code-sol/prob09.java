import java.util.*;
import java.io.*;

public class prob09{
  public static void main(String[] args) throws Exception{
    Scanner kb = new Scanner(new File("../input/prob09.txt"));


    while(kb.hasNextLine()){
      String phrase = kb.nextLine();
      System.out.println(compileString(phrase));
    }

  }

  public static String compileString(String p) {
    String s = "";

    for(int x = 0; x < p.length(); x++){
      if((p.charAt(x) >= 65 && p.charAt(x) <= 90) || p.charAt(x)==32){
        s += p.charAt(x)+"";
      }
      else{
        String nums = "";
        int n = Integer.parseInt(p.charAt(x)+"");
        nums += p.charAt(x)+"";
        for(int y = x+1; y < p.length(); y++){

          if(nums.equals("0")){
            break;
          }
          n = Integer.parseInt(p.charAt(y)+"");

          if((nums.equals("158") || nums.equals("13579") || nums.equals("9")) && n==0){
            nums += n+"";
            x = y;
            break;
          }
          else if(Integer.parseInt(p.charAt(y-1)+"") > n){
            x = y-1;
            break;
          }
          else{
            nums += n+"";
          }
        }
        s+= numberToLetter(Integer.parseInt(nums));
      }

    }
    return s;
  }

  public static String numberToLetter(int x){

    Map<Integer, String> map = new HashMap<Integer, String>();

    map.put(123457,"A"); map.put(1234567,"B"); map.put(456, "C"); map.put(1580, "D");
    map.put(12456, "E"); map.put(1249, "F"); map.put(12569, "G"); map.put(13457, "H");
    map.put(37, "I"); map.put(3567, "J"); map.put( 13459, "K"); map.put(156, "L");
    map.put(12357, "M"); map.put(3579, "N"); map.put(123567, "O"); map.put(1458, "P");
    map.put( 12347, "Q"); map.put(123459, "R"); map.put(12467, "S"); map.put(278, "T");
    map.put(1357, "U"); map.put(1379, "V"); map.put(135790, "W"); map.put(90, "X");
    map.put(1347, "Y"); map.put(23456, "Z");map.put(0, " ");
    if(map.get(x)==null){
      return "";
    }
      return map.get(x);
  }


}
