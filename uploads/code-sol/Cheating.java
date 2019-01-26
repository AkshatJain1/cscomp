import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

public class Cheating
{
    public static void main(String[] args) throws FileNotFoundException
    {
        Scanner file = new Scanner(new File("cheating.in"));
        System.out.println("public class Cheating\n{");
        System.out.println("\tpublic static void main(String[] args)\n\t{");
        while (file.hasNextLine())
        {
            String line = file.nextLine();
            // If line is empty, use empty println() statement as per the spec
            if (line.isEmpty())
            {
                System.out.println("\t\tSystem.out.println();");
            }
            else
            {
                // Escape backslashes first, then escape double quotes
                line = line.replace("\\", "\\\\").replace("\"", "\\\"");
                System.out.println("\t\tSystem.out.println(\"" + line + "\");");
            }
        }
        System.out.println("\t}\n}");
    }
}
