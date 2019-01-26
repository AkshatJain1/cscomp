import java.io.File;
import java.util.Arrays;
import java.util.Scanner;

public class Banner {
    public static void main(String[] args) throws Exception{
        Scanner kb = new Scanner(new File("banner_1.in"));
        int w = kb.nextInt(); kb.nextLine();
        String[] words = new String[w];
        for (int i = 0; i < w; i++) {
            words[i] = kb.next().toUpperCase();
        }
        int[] atIndex = new int[w];
        for (int i = 0; i < atIndex.length; i++) {
            atIndex[i] = -1*i;
        }
        String out = "";
        boolean allIn = true;
        int counter=0;
        while(allIn) {
            if(counter>=w){
                for(int i = 0; i < (counter-w+1)*2;i++){
                    out+=" ";
                }
            }
            allIn = false;
            for (int i = atIndex.length - 1; i >= 0; i--) {
                if(atIndex[i] >= words[i].length()) {
                    out+= "  ";
                }
                else if(atIndex[i]>=0) {
                    allIn = true;
                    out += words[i].charAt(atIndex[i]) + " ";
                }
                atIndex[i]++;
            }
            out+="\n";
            counter++;
        }
        System.out.println(out);

    }
}
