import java.io.File;
import java.util.Scanner;

public class Points {
    public static void main(String[] args) throws Exception {
        Scanner kb = new Scanner(new File("points.in"));
        int n = Integer.parseInt(kb.nextLine());
        double time = 0, points = 0;
        for (int i = 0; i < n; i++) {
            String t = kb.next();
            time += Integer.parseInt(t.substring(0,2)) + (Integer.parseInt(t.substring(3))/60.0);
            points += Integer.parseInt(kb.nextLine().substring(1));
        }
        double pts = (120.0/time) * points;
        System.out.println((int)(pts-pts%5));
    }
}
