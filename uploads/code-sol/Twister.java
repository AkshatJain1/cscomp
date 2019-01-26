import java.util.Scanner;
import java.io.File;

public class Twister{
    public static void main(String[] args) throws Exception{
        Scanner kb = new Scanner(new File("twister.in"));

        while(kb.hasNextLine()){
            int size = Integer.parseInt(kb.nextLine());

            if((size < 1 || size > 19) || size % 2 == 0){
                System.out.println("Not valid size");
            }
            else {
                int[][] spiral = fillSpiral(size);
                for (int x = 0;x<spiral.length;x++) {
                    for (int y = 0;y<spiral[0].length;y++ ) {
                        if(spiral[x][y] > 99)
                            System.out.print(spiral[x][y]+"   ");
                        else if(spiral[x][y] > 9)
                            System.out.print(" " + spiral[x][y]+"   ");
                        else
                            System.out.print("  "+spiral[x][y]+"   ");

                    }
                    System.out.println("\n");
                }
            }

            System.out.println("\n\n");
        }

    }

    public static int[][] fillSpiral(int size) {
        int[][] spiral = new int[size][size];
        //default all values to -1
        for (int x = 0;x<spiral.length;x++) {
            for (int y = 0;y<spiral[0].length;y++ ) {
                spiral[x][y] = -1;
            }
        }

        //start off
        int row = size/2;
        int col = size/2;
        spiral[row][col] = 0;
        col++;

        boolean right = true; boolean left = false; boolean up = false; boolean down = false;
        //filling values
        for(int x = 1; x < size*size; x++) {
            spiral[row][col] = x;

            if(right) {
                if(spiral[row-1][col] == -1){
                    right = false; up = true;

                    row--;
                }
                else{
                    col++;
                }
            }
            else if(up){
                if(spiral[row][col-1] == -1){
                    up = false; left = true;
                    col--;
                }
                else{
                    row--;
                }
            }
            else if(left){
                if(spiral[row+1][col] == -1){
                    left = false; down = true;
                    row++;
                }
                else{
                    col--;
                }
            }
            else if(down){
                if(spiral[row][col+1] == -1){
                    down = false; right = true;
                    col++;
                }
                else{
                    row++;
                }
            }
        }
        return spiral;
    }
}
