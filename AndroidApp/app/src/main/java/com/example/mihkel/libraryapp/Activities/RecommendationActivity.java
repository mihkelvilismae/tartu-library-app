package com.example.mihkel.libraryapp.Activities;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.AuthorAutocompleteListAdapter;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;

import java.util.ArrayList;

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
    private Button nextButton;
    private Button previousButton;
    private AutoCompleteTextView autocompleteView;

    private ArrayList<Item> selectedAuthors = new ArrayList<>();
    private ArrayList<Item> authors;
    private ArrayList<Item> selectedBooks = new ArrayList<>();
    private ArrayList<Item> books;
    private ArrayList<Item> selectedKeywords = new ArrayList<>();
    private ArrayList<Item> keywords;
    private ArrayList<Item> selectedGenre = new ArrayList<>();
    private ArrayList<Item> genres;

    private AuthorAutocompleteListAdapter authorAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recommendation);

        sexLayout = (LinearLayout) findViewById(R.id.sexLayout);
        previouslyLikedLayout = (LinearLayout) findViewById(R.id.previouslyLikedLayout);
        authorLayout = (LinearLayout) findViewById(R.id.authorLayout);
        genreLayout = (LinearLayout) findViewById(R.id.genreLayout);
        keywordsLayout = (LinearLayout) findViewById(R.id.keywordsLayout);
        likesReadingLayout = (LinearLayout) findViewById(R.id.likesReadingLayout);

        nextButton = (Button) findViewById(R.id.nextButton);
        nextButton.setOnClickListener(this);

        previousButton = (Button) findViewById(R.id.previousButton);
        previousButton.setOnClickListener(this);

        autocompleteView = (AutoCompleteTextView) findViewById(R.id.editAuthor);

        handleAuthorAutocomplete();
        hideAll();

    }

    //-----------------------------------------------------------------------------------------------------------------------
    // GENERIC text function start:
    private void removeChoiceFromSelected(Item choiceItem, Integer type) {
        if (type == R.id.TAG_AUTHOR) {
            selectedAuthors.remove(choiceItem);
            authorAdapter.add(choiceItem);
        }
    }

    private void addChoiceToSelected(Item choiceItem, Integer type) {
        if (type == R.id.TAG_AUTHOR) {
            selectedAuthors.add(choiceItem);
            authorAdapter.remove(choiceItem);
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
        authorAdapter = new AuthorAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_AUTHOR));

        autocompleteView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item author = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                autocompleteView.setText("");
                addChoiceToSelected(author, R.id.TAG_AUTHOR);
                toast(author.toString());
                drawSelectedAuthors();
            }
        });
        autocompleteView.setAdapter(authorAdapter);
        autocompleteView.setThreshold(0);
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
        authorAdapter = new AuthorAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_BOOK));

        autocompleteView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                autocompleteView.setText("");
                addChoiceToSelected(book, R.id.TAG_BOOK);
                toast(book.toString());
                drawSelectedAuthors();
            }
        });
        autocompleteView.setAdapter(authorAdapter);
        autocompleteView.setThreshold(0);
    }

    public void drawSelectedBooks() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.authorResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedAuthors) {
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
        authorAdapter = new AuthorAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_GENRE));

        autocompleteView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                autocompleteView.setText("");
                addChoiceToSelected(book, R.id.TAG_GENRE);
                toast(book.toString());
                drawSelectedAuthors();
            }
        });
        autocompleteView.setAdapter(authorAdapter);
        autocompleteView.setThreshold(0);
    }

    public void drawSelectedGenres() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.authorResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedAuthors) {
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
    // KEYWORDS start:

    public void handleKeywordsAutocomplete() {
        authorAdapter = new AuthorAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_KEYWORD));

        autocompleteView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                autocompleteView.setText("");
                addChoiceToSelected(book, R.id.TAG_KEYWORD);
                toast(book.toString());
                drawSelectedAuthors();
            }
        });
        autocompleteView.setAdapter(authorAdapter);
        autocompleteView.setThreshold(0);
    }

    public void drawSelectedKeywords() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.authorResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedAuthors) {
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
