import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

public class CSVParser {
	private static String outFilepath = "DegreePlannerOut.csv";
	private static String inFilepath = "courses.csv";

	public static void main(String args[]) {
		FileReader in = null;
		FileWriter out = null;
		try {
			in = new FileReader(new File(inFilepath));//set read and write destinations
			out = new FileWriter (new File(outFilepath));
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}

		char last = 0, current = 0;
		try {
			while (in.ready()) {//goes to the end of the file
				current = (char) in.read();
				if (last ==',' && current ==','){//inserts null into blank columns
					out.write("null");
				}
				out.write(current);//put each character into the output file
				last = current;
			}
		} catch (IOException e) {
			e.printStackTrace();
		}
		
		try {//close all resourses
			in.close();
			out.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

}
