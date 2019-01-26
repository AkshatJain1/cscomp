import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Scanner;

public class Rankings
{
    public static void main(String[] args) throws FileNotFoundException
    {
        Scanner file = new Scanner(new File("rankings.in"));
        ArrayList<String> schoolCodes = new ArrayList<>();
        ArrayList<Integer> topScores = new ArrayList<>();
        while (file.hasNextLine())
        {
            String[] line = file.nextLine().split(",");
            // If line contains a school code, store it
            if (Character.isDigit(line[0].charAt(0)))
            {
                schoolCodes.add(line[1]);
                topScores.add(Integer.MIN_VALUE);
            }
            // If line contains a new best test score for that school, store it
            else
            {
                int schoolCode = Integer.parseInt(line[1]);
                int testScore = Integer.parseInt(line[2]);
                if (testScore > topScores.get(schoolCode))
                {
                    topScores.set(schoolCode, testScore);
                }
            }
        }
        ArrayList<Integer> topScoresSorted = new ArrayList<>(topScores);
        Collections.sort(topScoresSorted);
        Collections.reverse(topScoresSorted);
        String[] medals = {"GOLD", "SILVER", "BRONZE"};
        // Get top three schools
        for (int i = 0; i < 3; i++)
        {
            int schoolCode = topScores.indexOf(topScoresSorted.get(i));
            String school = schoolCodes.get(schoolCode);
            int score = topScoresSorted.get(i);
            System.out.printf("%s: %s (%d points)\n", medals[i], school, score);
        }
    }
}
