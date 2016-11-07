package com.example.mihkel.libraryapp.Activities;

import android.app.Dialog;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.GridView;
import android.widget.LinearLayout;
import android.widget.NumberPicker;
import android.widget.TextView;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.TextAutocompleteListAdapter;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;

import java.util.ArrayList;
import java.util.List;

public class RecommendationActivity extends AppCompatActivity implements View.OnClickListener, ParseStringCallBackListener {
//    private static final int OBJECT = 1;
//    private static final int TAG_AUTHOR = 2;
//    private static final int TAKE_PICTURE = 1;


    public Integer visibleLevel = 0;
    public Integer activeLevel = 0;

    //    private Fragment authorFragment;
    private LinearLayout sexLayout;
    private LinearLayout previouslyLikedLayout;
    private LinearLayout authorLayout;
    private LinearLayout genreLayout;
    private LinearLayout keywordsLayout;
    private LinearLayout likesReadingLayout;
    private LinearLayout ageLayout;
    private Button nextButton;
    private Button previousButton;

    private ArrayList<Item> selectedAuthors = new ArrayList<>();
    private ArrayList<Item> authors;
    private ArrayList<Item> selectedBooks = new ArrayList<>();
    private ArrayList<Item> books;
    private ArrayList<Item> selectedKeywords = new ArrayList<>();
    private ArrayList<Item> keywords;
    private ArrayList<Item> selectedGenres = new ArrayList<>();
    private ArrayList<Item> genres;

    private TextAutocompleteListAdapter authorAdapter;
    private TextAutocompleteListAdapter genreAdapter;
    private TextAutocompleteListAdapter keywordAdapter;
    private TextAutocompleteListAdapter bookAdapter;

    AutoCompleteTextView authorAutoCompleteTextView;
    AutoCompleteTextView genreAutoCompleteTextView;
    AutoCompleteTextView keywordAutoCompleteTextView;
    AutoCompleteTextView bookAutoCompleteTextView;
    private Button sexButtonF;
    private Button sexButtonM;
    private Button likesReadingButtonY;
    private Button likesReadingButtonN;
    private Button ageButton;
    private Button startYearButton;
    private Button endYearButton;
//    private GridView ageGridView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recommendation);

        sexLayout = (LinearLayout) findViewById(R.id.sexLayout);
        previouslyLikedLayout = (LinearLayout) findViewById(R.id.booksLayout);
        authorLayout = (LinearLayout) findViewById(R.id.authorLayout);
        genreLayout = (LinearLayout) findViewById(R.id.genreLayout);
        keywordsLayout = (LinearLayout) findViewById(R.id.keywordsLayout);
        likesReadingLayout = (LinearLayout) findViewById(R.id.likesReadingLayout);
        ageLayout = (LinearLayout) findViewById(R.id.ageLayout);

        nextButton = (Button) findViewById(R.id.nextButton);
        nextButton.setOnClickListener(this);

        previousButton = (Button) findViewById(R.id.previousButton);
        previousButton.setOnClickListener(this);

        sexButtonF = (Button) findViewById(R.id.sexButtonF);
        sexButtonF.setOnClickListener(this);

        sexButtonM = (Button) findViewById(R.id.sexButtonM);
        sexButtonM.setOnClickListener(this);

        likesReadingButtonY = (Button) findViewById(R.id.likesReadingY);
        likesReadingButtonY.setOnClickListener(this);

        likesReadingButtonN = (Button) findViewById(R.id.likesReadingN);
        likesReadingButtonN.setOnClickListener(this);

//        ageButton = (Button) findViewById(R.id.ageButton);
//        ageButton.setOnClickListener(this);

        startYearButton = (Button) findViewById(R.id.startYearButton);
        startYearButton.setOnClickListener(this);

        endYearButton = (Button) findViewById(R.id.endYearButton);
        endYearButton.setOnClickListener(this);

        handleAuthorAutocomplete();
        handleGenreAutocomplete();
        handleBookAutocomplete();
        handleKeywordsAutocomplete();

//        initToggleButtons(likes);

        hideAll();

    }

    //-----------------------------------------------------------------------------------------------------------------------
    // BUTTONS start:

    // BUTTONS end
    //-----------------------------------------------------------------------------------------------------------------------
    // GENERIC text function start:
    private void removeChoiceFromSelected(Item choiceItem, Integer type) {
        switch (type) {
            case R.id.TAG_AUTHOR:
                selectedAuthors.remove(choiceItem);
                authorAdapter.add(choiceItem);
                break;
            case R.id.TAG_BOOK:
                selectedBooks.remove(choiceItem);
                bookAdapter.add(choiceItem);
                break;
            case R.id.TAG_GENRE:
                selectedGenres.remove(choiceItem);
                genreAdapter.add(choiceItem);
                break;
            case R.id.TAG_KEYWORD:
                selectedKeywords.remove(choiceItem);
                keywordAdapter.add(choiceItem);
                break;
        }
    }

    private void addChoiceToSelected(Item choiceItem, Integer type) {
        switch (type) {
            case R.id.TAG_AUTHOR:
                selectedAuthors.add(choiceItem);
                authorAdapter.remove(choiceItem);
                break;
            case R.id.TAG_BOOK:
                selectedBooks.add(choiceItem);
                bookAdapter.remove(choiceItem);
                break;
            case R.id.TAG_GENRE:
                selectedGenres.add(choiceItem);
                genreAdapter.remove(choiceItem);
                break;
            case R.id.TAG_KEYWORD:
                selectedKeywords.add(choiceItem);
                keywordAdapter.remove(choiceItem);
                break;
        }
    }

    private void removeItem(View buttonView) {
        Integer itemType = (Integer) buttonView.getTag(R.id.TAG_TYPE);
        switch (itemType) {
            case R.id.TAG_AUTHOR:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_AUTHOR);
                drawSelectedAuthors();
                break;
            case R.id.TAG_BOOK:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_BOOK);
                drawSelectedBooks();
                break;
            case R.id.TAG_GENRE:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_GENRE);
                drawSelectedGenres();
                break;
            case R.id.TAG_KEYWORD:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_KEYWORD);
                drawSelectedKeywords();
                break;
        }
    }
    // GENERIC text function end.
    //-----------------------------------------------------------------------------------------------------------------------
    // AUTHOR start:

    public void handleAuthorAutocomplete() {
        authorAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_AUTHOR), R.id.TAG_AUTHOR);

        authorAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editAuthor);
        authorAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownViewItem, int position, long id) {
                Item author = (Item) dropdownViewItem.getTag(R.id.TAG_OBJECT);
                authorAutoCompleteTextView.setText("");
                addChoiceToSelected(author, R.id.TAG_AUTHOR);
                toast(author.toString());
                drawSelectedAuthors();
            }
        });
        authorAutoCompleteTextView.setAdapter(authorAdapter);
        authorAutoCompleteTextView.setThreshold(0);
    }

    public void drawSelectedAuthors() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.authorResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedAuthors) {
            //view generation
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            //remove button
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_AUTHOR);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }


    // AUTHOR end:
    //-----------------------------------------------------------------------------------------------------------------------
    // BOOKS start:

    public void handleBookAutocomplete() {
        bookAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_BOOK), R.id.TAG_BOOK);

        bookAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editBook);
        bookAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                bookAutoCompleteTextView.setText("");
                addChoiceToSelected(book, R.id.TAG_BOOK);
                toast(book.toString());
                drawSelectedBooks();
            }
        });
        bookAutoCompleteTextView.setAdapter(bookAdapter);
        bookAutoCompleteTextView.setThreshold(0);
    }

    public void drawSelectedBooks() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.bookResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedBooks) {
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_BOOK);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }
    // BOOKS end:
    //-----------------------------------------------------------------------------------------------------------------------
    // GENRES start:

    public void handleGenreAutocomplete() {
        genreAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_GENRE), R.id.TAG_GENRE);

        genreAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editGenre);
        genreAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                genreAutoCompleteTextView.setText("");
                addChoiceToSelected(book, R.id.TAG_GENRE);
                toast(book.toString());
                drawSelectedGenres();
            }
        });
        genreAutoCompleteTextView.setAdapter(genreAdapter);
        genreAutoCompleteTextView.setThreshold(0);
    }

    public void drawSelectedGenres() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.genreResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedGenres) {
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_GENRE);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }
    // GENRES end:
    //-----------------------------------------------------------------------------------------------------------------------
    // AGE start:
//    public List<String> makeAgeList() {
//        List<String> ageList = new ArrayList<>();
//        for (int i = 7; i < 99; i++) {
//            ageList.add(String.valueOf(i));
//        }
//        return ageList;
//    }
//
//    public void createAgeGrid() {
//        ageGridView = (GridView) findViewById(R.id.gridView1);
//
//		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, makeAgeList());
//
//		ageGridView.setAdapter(adapter);
//
//		ageGridView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
//			public void onItemClick(AdapterView<?> parent, View v, int position, long id) {
//			   Toast.makeText(getApplicationContext(), ((TextView) v).getText(), Toast.LENGTH_SHORT).show();
//			}
//		});
//    }
    // AGE
    //-----------------------------------------------------------------------------------------------------------------------
    // KEYWORDS start:

    public void handleKeywordsAutocomplete() {
        keywordAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_KEYWORD), R.id.TAG_KEYWORD);

        keywordAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editKeyword);
        keywordAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                keywordAutoCompleteTextView.setText("");
                addChoiceToSelected(book, R.id.TAG_KEYWORD);
                toast(book.toString());
                drawSelectedKeywords();
            }
        });
        keywordAutoCompleteTextView.setAdapter(keywordAdapter);
        keywordAutoCompleteTextView.setThreshold(0);
    }

    public void drawSelectedKeywords() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.keywordResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedKeywords) {
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_KEYWORD);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }
    // KEYWORDS end:
    //------------------------------------------------------------------------------------------------------
    // YEAR start:

    public void initYear() {
//        b.setText("" + year);
        startYearButton.setOnClickListener(this);
        endYearButton.setOnClickListener(this);


    }

    public void showYearDialog(View v) {
        final Boolean isStartYearDialog = (v.getId() == R.id.startYearButton);
        final Dialog d = new Dialog(this);
        d.setTitle("Year Picker");
        d.setContentView(R.layout.dialog_year);
        Button set = (Button) d.findViewById(R.id.button1);
        Button cancel = (Button) d.findViewById(R.id.button2);
        final NumberPicker nopicker = (NumberPicker) d.findViewById(R.id.numberPicker1);

        int year = 2016;
        nopicker.setMaxValue(year + 50);
        nopicker.setMinValue(year - 50);
        nopicker.setWrapSelectorWheel(false);
        nopicker.setValue(year);
        nopicker.setDescendantFocusability(NumberPicker.FOCUS_BLOCK_DESCENDANTS);

        set.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (isStartYearDialog)
                    ((Button) findViewById(R.id.startYearButton)).setText("Alates " + String.valueOf(nopicker.getValue()));
                else
                    ((Button) findViewById(R.id.endYearButton)).setText("Kuni " + String.valueOf(nopicker.getValue()));
                d.dismiss();
            }
        });
        cancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                d.dismiss();
            }
        });
        d.show();


    }
    // YEAR end
    //----------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------
    // DRAWING FIELDS start:


    private void showPreviousField() {
        visibleLevel--;
        activeLevel--;
        showToLevel(visibleLevel);
//        toast("level now: " + visibleLevel);
    }

    private void showNextField() {
        visibleLevel++;
        activeLevel++;
        showToLevel(visibleLevel);
//        toast("level now: " + visibleLevel);
    }

    public void hideAll() {
        sexLayout.setVisibility(View.GONE);
        previouslyLikedLayout.setVisibility(View.GONE);
        authorLayout.setVisibility(View.GONE);
        genreLayout.setVisibility(View.GONE);
        keywordsLayout.setVisibility(View.GONE);
        likesReadingLayout.setVisibility(View.GONE);
    }

    public void showToLevel(int level) {
        if (level >= 0)
            showAgeField();
        if (level >= 1)
            showSexField();
        if (level >= 2)
            showLikesReadingField();
        if (level >= 3)
            showLanguageField();
        if (level >= 4)
            showAuthorField();
        if (level >= 5)
            showGenreField();
        if (level >= 6)
            showYearField();
        if (level >= 7)
            showPreviouslyLikedField();
        if (level >= 8)
            showKeyWordsField();
    }

    public void showAgeField() {
//        ageLayout.setVisibility(View.VISIBLE);
    }

    public void showSexField() {
        sexLayout.setVisibility(View.VISIBLE);
    }

    public void showLikesReadingField() {
        likesReadingLayout.setVisibility(View.VISIBLE);
    }

    public void showLanguageField() {
//        lan.setVisibility(View.VISIBLE);

    }

    public void showAuthorField() {
        authorLayout.setVisibility(View.VISIBLE);
    }

    public void showGenreField() {
        genreLayout.setVisibility(View.VISIBLE);

    }

    public void showYearField() {
//        genreLayout.setVisibility(View.VISIBLE);

    }

    public void showPreviouslyLikedField() {
        previouslyLikedLayout.setVisibility(View.VISIBLE);
    }

    public void showKeyWordsField() {
        keywordsLayout.setVisibility(View.VISIBLE);

    }

    // DRAWING FIELDS end
    //------------------------------------------------------------------------------------------------------
    @Override
    public void onClick(View v) {
        Integer defaultBackgroundColor = 0;
        switch (v.getId()) {
            case R.id.nextButton:
                showNextField();
                break;
            case R.id.previousButton:
                showPreviousField();
                break;
            case R.id.removeButton:
                removeItem(v);
                break;
            case R.id.likesReadingY:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.likesReadingN)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.likesReadingN:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.likesReadingY)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.sexButtonF:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.sexButtonM)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.sexButtonM:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.sexButtonF)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.startYearButton:
                showYearDialog(v);
                break;
            case R.id.endYearButton:
                showYearDialog(v);
                break;
        }
    }

    public void startResultActivity() {
//        Intent calendarStartIntent = new Intent(this, SchoolsListActivity.class);
//        startActivity(calendarStartIntent);
//        toast("startRecommendationActivity");
    }

    public void startResult() {
//        if (true || !DatabaseManagerSingleton.getInstance().hasSchoolsList())
//            fetchDataFromServer();
//        else
//            startMandatoryReadingActivity();
    }

    public void toast(String text) {
        Toast.makeText(getApplicationContext(), text, Toast.LENGTH_SHORT).show();
    }

    public void fetchDataFromServer() {
//        JsonTask jsonTask = new JsonTask(RecommendationActivity.this).setListener(this);
//        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Koolid");
    }

    @Override
    public void callback(String jsonString) {
//        DatabaseManagerSingleton.getInstance().setSchoolListResult(jsonString);
//        startMandatoryReadingActivity();
    }

    //-----------------------------------------------------------------------------------------------------------------------
    // DEFAULT start:
    //-----------------------------------------------------------------------------------------------------------------------

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


}
