import java.io.File;
import java.util.Scanner;

public class pizza {
    public static void main(String[] args)throws Exception
    {
        Scanner file = new Scanner(new File("pizza.in"));
        while(file.hasNext())
        {
            double total = 0;
            file.nextLine();
            String temp = file.nextLine();
            String[] money = temp.split(" ");
            for(String s:money)
            {
                total+=Double.parseDouble(s);
            }
            System.out.println((int)(total/file.nextDouble())+" pizzas");
        }
    }
}